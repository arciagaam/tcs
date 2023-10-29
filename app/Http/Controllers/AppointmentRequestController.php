<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequestUpdateRequest;
use App\Models\Appointment;
use App\Models\Student;
use App\Models\TeacherStudent;
use App\Models\UserRole;
use Illuminate\Http\Request;

class AppointmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (checkRole(auth()->user(), [2, 3, 4])) {
            $teacherIds = UserRole::where('user_id', auth()->user()->id)->get()->map(fn($value) => $value->id);
            $studentIds = TeacherStudent::whereIn('teacher_id', $teacherIds)->get()->map(fn($value) => $value->student_id);
            $groupCodes = Student::whereIn('id', $studentIds)->get()->map(fn($value) => $value->group_code);

            $appointments = Appointment::whereIn('group_code', $groupCodes)->with(['user.student'])->paginate(10);
        } else {
            $appointments = Appointment::with(['user.student'])->paginate(10);

        }

        $pendingAppointments = collect($appointments->items())->filter(fn($value) => $value->status == 1);
        $appointmentsList = collect($appointments->items())->filter(fn($value) => $value->status != 1);
        
        return view('pages.appointments.requests.index', compact('pendingAppointments', 'appointmentsList'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $request)
    {
        $appointment = $request;
        return view('pages.appointments.requests.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequestUpdateRequest $formRequest, Appointment $request)
    {
        $appointment = $request;
        $request = $formRequest;

        $appointment->update(['status' => '2', ...$request->validated()]);

        return redirect()->route('appointments.requests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
