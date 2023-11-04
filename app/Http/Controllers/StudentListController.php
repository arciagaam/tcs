<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use App\Models\StudentSubmission;
use App\Models\TeacherStudent;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class StudentListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Builder $query, Role $role)
    {
        $teacherId = UserRole::where('user_id', auth()->user()->id)->where('role_id', $role->id)->first()->id;
        $students = TeacherStudent::with('student')->where('teacher_id', $teacherId)->get()->map(fn($value) => $value->student_id)->values();
        $submissions = StudentSubmission::with('student.user')->whereIn('student_id', $students)->where('role_id', $role->id)->paginate(20);
        return view('pages.admin_pages.students.list.index', compact('submissions', 'role'));
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
