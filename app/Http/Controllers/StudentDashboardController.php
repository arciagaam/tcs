<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadGanttChartRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{

    public function index()
    {
        return view('pages.student_pages.dashboard.index');
    }

    public function store(UploadGanttChartRequest $request)
    {
        $name = $request->validated('gantt_chart_image_path')->getClientOriginalName();
        $storedFile = $request->validated('gantt_chart_image_path')->storeAs("files", $name, 'public');

        Student::where('user_id', auth()->user()->id)->update(['gantt_chart_image_path' => $storedFile]);
        return back()->with('toastData', ['status' => 'success', 'message' => "Gantt Chart updated"]);
    }
}
