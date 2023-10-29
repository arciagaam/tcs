<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TeacherStudent;
use App\Models\Tracking;
use App\Models\UserRole;
use Illuminate\Http\Request;

class TrackingController extends Controller
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

            $trackings = Tracking::latest()->whereIn('group_code', $groupCodes)->paginate(10);
        } else {
            $trackings = Tracking::latest()->paginate(10);
        }
        return view('pages.tracking.index', compact('trackings'));
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
