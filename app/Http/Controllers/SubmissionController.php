<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentSubmissionCheckRequest;
use App\Models\StudentSubmission;
use App\Models\SubmissionCheck;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(StudentSubmission $submission)
    {
        $submission = StudentSubmission::where('id', $submission->id)->with('check')->first();
        return view('pages.submissions.show', compact('submission'));
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

    public function check(StudentSubmission $submission, StudentSubmissionCheckRequest $request) {
        $submission->update(['isChecked' => 1]);
                
        $name = $request->validated('check_file')->getClientOriginalName();
        $storedFile = $request->validated('check_file')->storeAs("files/check", $name, 'public');

        SubmissionCheck::create([
            'student_submission_id' => $submission->id,
            'file_name' => $name,
            'file_path' => $storedFile,
            'remarks' => $request->validated('remarks')
        ]);

        return back();
    }
}
