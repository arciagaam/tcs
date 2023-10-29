<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFile;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index() {
        $pendingRegistrations = StudentFile::with(['student.user', 'toUserId', 'toRoleId'])
        ->whereIn('to_role_id', getUserRoleIds())
        ->where('to_user_id', auth()->user()->id)
        ->where('status', 1)
        ->paginate(20);
        return view('pages.admin_pages.dashboard.index', compact('pendingRegistrations'));
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

        return back();
    }
}
