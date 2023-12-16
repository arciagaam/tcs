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
}
