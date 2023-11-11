<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Report;
use App\Models\Student;
use App\Models\StudentFile;
use App\Models\TeacherStudent;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $teacherIds = UserRole::where('user_id', auth()->user()->id)->get()->map(fn($value) => $value->id);
        $studentIds = TeacherStudent::whereIn('teacher_id', $teacherIds)->groupBy('student_id')->select('student_id')->get()->map(fn($value) => $value->student_id);
        $groupCodes = Student::whereIn('id', $studentIds)->get()->map(fn($value) => $value->group_code);

        $studentCount = count($studentIds);
        $groupCount = count($groupCodes);
        $appointmentCount = Appointment::whereIn('user_role_id', $teacherIds)->whereIn('group_code', $groupCodes)->count();
        $reportCount = Report::whereIn('user_role_id', $teacherIds)->whereIn('group_code', $groupCodes)->count();

        $pendingRegistrations = StudentFile::with(['student.user', 'toUserId', 'toRoleId'])
        ->whereIn('to_role_id', getUserRoleIds())
        ->where('to_user_id', auth()->user()->id)
        ->where('status', 1)
        ->paginate(20);

        return view('pages.admin_pages.dashboard.index', compact('pendingRegistrations', 'studentCount', 'groupCount', 'appointmentCount', 'reportCount'));
    }

    function update(StudentFile $studentFile, Request $request) {
        $studentFile->update(['status' => $request->verdict == 1 ? 2 : 3]);

        if($request->verdict == 1) {
            $teacherId = UserRole::where('user_id', $studentFile->to_user_id)->where('role_id', $studentFile->to_role_id)->first();
            $teacherId->handledStudents()->attach([$studentFile->student_id]);
        }
        if($request->verdict != 1) {
            $studentFile->delete();
        }

        $name = formatName($studentFile->student->user);
        return back()->with('toastData', ['status' => 'success', 'message' => "Student $name approved"]);
    }
}
