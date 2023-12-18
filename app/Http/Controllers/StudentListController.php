<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use App\Models\Student;
use App\Models\StudentSubmission;
use App\Models\TeacherStudent;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Builder $query, Role $role)
    {
        $teacherId = UserRole::where('user_id', auth()->user()->id)->where('role_id', $role->id)->first()->id;
        $students = TeacherStudent::with('student')->where('teacher_id', $teacherId)->get()->map(fn($value) => $value->student_id)->values();
        // dd($students);
        $submissions = StudentSubmission::with('student.user')->whereIn('student_id', $students)->where('role_id', $role->id)->paginate(20);
        $studentList = Student::whereHas('user', function($q) {
            $q->withoutTrashed();
        })->paginate();

        return view('pages.admin_pages.students.list.index', compact('submissions', 'role', 'studentList'));
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
    public function show(Student $student)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
