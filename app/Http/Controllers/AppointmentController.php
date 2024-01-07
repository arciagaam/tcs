<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Mail\StudentAppointmentMail;
use App\Mail\StudentAppointmentRequestMail;
use App\Mail\TeacherAppointmentMail;
use App\Models\Appointment;
use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\TeacherStudent;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherIds = UserRole::where('user_id', auth()->user()->id)->get()->map(fn ($value) => $value->id);

        $appointment = Appointment::whereIn('user_role_id', $teacherIds)->paginate(10);

        $pendingAppointments = collect($appointment->items())->filter(fn ($value) => $value->status == 1);
        $appointmentsList = collect($appointment->items())->filter(fn ($value) => $value->status != 1);
        $panels = null;

        if (checkRole(auth()->user(), [5])) {
            $student = auth()->user()->student;
            $ta = $student->files->filter(fn ($value) => ($value->status == 2 && $value->to_role_id == 2))->values()->first();
            $te = $student->files->filter(fn ($value) => ($value->status == 2 && $value->to_role_id == 3))->values()->first();
            $se = $student->files->filter(fn ($value) => ($value->status == 2 && $value->to_role_id == 4))->values()->first();

            $ta = UserRole::where('user_id', $ta->to_user_id ?? null)->where('role_id', $ta->to_role_id ?? null)->with('user')->first() ?? null;
            $te = UserRole::where('user_id', $te->to_user_id ?? null)->where('role_id', $te->to_role_id ?? null)->with('user')->first() ?? null;
            $se = UserRole::where('user_id', $se->to_user_id ?? null)->where('role_id', $se->to_role_id ?? null)->with('user')->first() ?? null;

            $panels = ['Thesis Adviser' => $ta, 'Technical Editor' => $te, 'System Expert' => $se];
        }

        return view('pages.appointments.index', compact('pendingAppointments', 'appointmentsList', 'panels', 'teacherIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request)
    {
        $roles = auth()->user()->roles;
        
        if (checkRole(auth()->user(), [5]) && !$request->validated('panel')) {
            return back()->with('toastData', ['status' => 'error', 'message' => "Select a panel"]);
        }
        
        if ($request->validated('document')) {
            $name = $request->validated('document')->getClientOriginalName();
            $storedFile = $request->validated('document')->storeAs("files", $name, 'public');
        }
        
        if ($request->validated('video')) {
            $videoName = $request->validated('video')->getClientOriginalName();
            $videoStoredFile = $request->validated('video')->storeAs("files", $videoName, 'public');
        }
        
        if ($request->validated('role_id')) {
            $teacher = UserRole::where('user_id', auth()->user()->id)
                ->where('role_id', $request->validated('role_id'))
                ->first();

            if (!$teacher) {
                return back()->with('toastData', ['status' => 'error', 'message' => "Teacher not found"]);
            }

            $students = Student::where('group_code', $request->validated('group_code'))->get()->map(fn ($s) => $s->id);

            $teacherStudents = TeacherStudent::where('teacher_id', $teacher->id)->whereIn('student_id', $students)->get();

            if (!$teacherStudents->count()) {
                $role = Role::find($request->validated('role_id'));
                return back()->with('toastData', ['status' => 'error', 'message' => "You are not a $role->name for this group."]);
            }


        }

        Appointment::create([
            'user_id' => auth()->user()->id,
            'document_path' => $storedFile ?? null,
            'video_path' => $videoStoredFile ?? null,
            'status' => $roles->contains(fn ($value) => $value->id < 5) ? 2 : 1,
            'user_role_id' => $request->validated('panel') ?? $teacher->id,
            ...$request->safe()->except('panel')
        ]);

        $students = Student::where('group_code', $request->validated('group_code'))->get();

        $studentIds = $students->map(fn ($val) => $val->id);
        $userRoleIds = TeacherStudent::whereIn('student_id', $studentIds)->groupBy('teacher_id')->select('teacher_id')->get();
        $teacherIds = UserRole::whereIn('user_id', $userRoleIds)->groupBy('user_id')->select('user_id')->get();
        $teachers = User::whereIn('id', $teacherIds)->get();

        if (checkRole(auth()->user(), [5])) {

            foreach ($teachers as $teacher) {
                Mail::to($teacher->email)->queue(new StudentAppointmentRequestMail(formatName($teacher), $request->validated('group_code'), Carbon::parse($request->validated('start_date'))->format('m/d h:m')));
                // $this->sendSMS(TEACHER NUMBER, CONTENT SA MAIL);
            }

            // logActivity(formatName(auth()->user(), true), auth()->user()->email, "$requestGroupCode requested an appointment on $request->start_date", $requestGroupCode);

        } else {

            foreach ($teachers as $teacher) {
                Mail::to($teacher->email)->queue(new TeacherAppointmentMail(formatName($teacher, false), $request->validated('group_code'), Carbon::parse($request->validated('start_date'))->format('m/d h:m')));
                // $this->sendSMS(TEACHER NUMBER, CONTENT SA MAIL);
            }

            foreach ($students as $student) {
                Mail::to($student->user->email)->queue(new StudentAppointmentMail(formatName($student->user, false), $request->validated('group_code'), Carbon::parse($request->validated('start_date'))->format('m/d h:m')));
                // $this->sendSMS(STUDENT NUMBER, CONTENT SA MAIL);
            }

            // logActivity(formatName(auth()->user(), true), auth()->user()->email, "Created an appointment for $requestGroupCode on $request->start_date_time", $requestGroupCode);

        }

        return redirect()->route('appointments.index')->with('toastData', ['status' => 'success', 'message' => "Appointment created!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update(['status' => $request->verdict == 1 ? 2 : 3]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function get(Request $request)
    {

        if (!checkRole(auth()->user(), [1])) {

            if (checkRole(auth()->user(), [2, 3, 4])) {
                $teacherIds = UserRole::where('user_id', auth()->user()->id)->get()->map(fn ($value) => $value->id);
                $studentIds = TeacherStudent::whereIn('teacher_id', $teacherIds)->get()->map(fn ($value) => $value->student_id);
                $groupCodes = Student::whereIn('id', $studentIds)->get()->map(fn ($value) => $value->group_code);

                $appointments = Appointment::where('status', 2)->whereIn('group_code', $groupCodes)->whereIn('user_role_id', $teacherIds)->get();
            } else {
                $appointments = Appointment::where('status', 2)->where('group_code', auth()->user()->student->group_code)->get();
            }
        } else {
            $appointments = Appointment::where('status', 2)->get();
        }

        return response(json_encode($appointments), 200);
    }
}
