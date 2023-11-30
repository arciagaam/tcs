<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentSubmissionStoreRequest;
use App\Models\Role;
use App\Models\StudentSubmission;
use App\Models\Tracking;
use Illuminate\Http\Request;

class StudentSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Role $role)
    {
        $submissions = StudentSubmission::where('group_code', auth()->user()->student->group_code)->where('role_id', $role->id)->get();
        $fileSubmissions = $submissions->filter(fn($value) => $value->file_type=='file');
        $videoSubmissions = $submissions->filter(fn($value) => $value->file_type=='video');
        return view('pages.student_pages.teachers.submissions.index', compact('role', 'fileSubmissions', 'videoSubmissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Role $role)
    {
        return view('pages.student_pages.teachers.submissions.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Role $role, StudentSubmissionStoreRequest $request)
    {
        $group_code = auth()->user()->student->group_code;
        $uploadedFile = $request->validated('file_submission');

        if($uploadedFile) {
            $name = $uploadedFile->getClientOriginalName();
            $storedFile = $uploadedFile->storeAs("files/submissions/$group_code", $name, 'public');
        }

        $submission = StudentSubmission::create([
            'student_id' => auth()->user()->student->id,
            'group_code' => $group_code,
            'role_id' => $role->id,
            'file_type' => $request->validated('type') ?? null,
            'file_name' => $name ?? null,
            'path' => $storedFile ?? null,
            ...$request->safe()->only('name')
        ]);

        $count = Tracking::where('group_code', $group_code)->latest()->first()->number ?? 0;
        $panelUsers = session('panel_users');
        Tracking::create([
            'student_submission_id' => $submission->id,
            'to_user_id' => $panelUsers[$role] ?? null,
            'group_code' => $group_code,
            'number' => $count+1,
            'name' => $request->validated('name'),
            'file_name' => $name ?? null,
            'file_path' => $storedFile ?? null,
        ]);

        return redirect()->route('panel-members.submissions.index', ['role' => $role]);
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
