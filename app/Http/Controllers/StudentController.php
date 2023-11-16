<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadGanttChartRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user'])->paginate(20);

        if(checkRole(auth()->user(), [1])) {

        } else {
            
            // $studentIdArray = Student::with(['user' => function($query){
            //     $query->whereIn('groups.id', auth()->user()->groups->map(fn($value) => $value->id));
            // }])->get()->filter(fn($value) => (count($value->user->groups)))->map(fn($value) => $value->id);

            // $students = Student::whereIn('students.id', $studentIdArray)->with(['user'])->paginate(20);
        }

        return view('pages.students.index', compact('students'));
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
