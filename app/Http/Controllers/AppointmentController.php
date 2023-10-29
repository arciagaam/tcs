<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Mail\StudentAppointmentMail;
use App\Mail\StudentAppointmentRequestMail;
use App\Mail\TeacherAppointmentMail;
use App\Models\Appointment;
use App\Models\Group;
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
        $appointment = Appointment::paginate(10);
        $pendingAppointments = collect($appointment->items())->filter(fn($value) => $value->status == 1);
        $appointmentsList = collect($appointment->items())->filter(fn($value) => $value->status != 1);

        return view('pages.appointments.index', compact('pendingAppointments', 'appointmentsList'));
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

        if($request->validated('document')) {
            $name = $request->validated('document')->getClientOriginalName();
            $storedFile = $request->validated('document')->storeAs("files", $name, 'public');
        }

        Appointment::create(['user_id' => auth()->user()->id, 
        'document_path' => $storedFile ?? null,
        'status' => $roles->contains(fn($value) => $value->id < 5) ? 2 : 1, 
        ...$request->validated()]);

        $students = Student::where('group_code', $request->validated('group_code'))->get();

        $studentIds = $students->map(fn($val) => $val->id);
        $teacherIds = TeacherStudent::whereIn('student_id', $studentIds)->groupBy('teacher_id')->select('teacher_id')->get();
        $teachers = User::whereIn('id', $teacherIds)->get();

        if (checkRole(auth()->user(), [5])) {
            
            foreach ($teachers as $teacher) {
                Mail::to($teacher->email)->send(new StudentAppointmentRequestMail(formatName($teacher), $request->validated('group_code'), Carbon::parse($request->validated('start_date'))->format('m/d h:m')));
                // $this->sendSMS(TEACHER NUMBER, CONTENT SA MAIL);
            }
            
            // logActivity(formatName(auth()->user(), true), auth()->user()->email, "$requestGroupCode requested an appointment on $request->start_date", $requestGroupCode);
            
        } else {

            foreach ($teachers as $teacher) {
                Mail::to($teacher->email)->send(new TeacherAppointmentMail(formatName($teacher, false), $request->validated('group_code'), Carbon::parse($request->validated('start_date'))->format('m/d h:m')));
                // $this->sendSMS(TEACHER NUMBER, CONTENT SA MAIL);
            }

            foreach ($students as $student) {
                Mail::to($student->user->email)->send(new StudentAppointmentMail(formatName($student->user, false), $request->validated('group_code'), Carbon::parse($request->validated('start_date'))->format('m/d h:m')));
                // $this->sendSMS(STUDENT NUMBER, CONTENT SA MAIL);
            }

            // logActivity(formatName(auth()->user(), true), auth()->user()->email, "Created an appointment for $requestGroupCode on $request->start_date_time", $requestGroupCode);

        }

        return redirect()->route('appointments.index');
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

    public function get(Request $request) {
        if (!checkRole(auth()->user(), [1])) {

            if (checkRole(auth()->user(), [2, 3, 4])) {
                $teacherIds = UserRole::where('user_id', auth()->user()->id)->get()->map(fn($value) => $value->id);
                $studentIds = TeacherStudent::whereIn('teacher_id', $teacherIds)->get()->map(fn($value) => $value->student_id);
                $groupCodes = Student::whereIn('id', $studentIds)->get()->map(fn($value) => $value->group_code);

                $appointments = Appointment::where('status', 2)->whereIn('group_code', $groupCodes)->get();
            } else {
                $appointments = Appointment::where('status', 2)->where('group_code', auth()->user()->student->group_code)->get();
            }
        } else {
            $appointments = Appointment::where('status', 2)->get();
        }

        return response(json_encode($appointments), 200);
    }
}
