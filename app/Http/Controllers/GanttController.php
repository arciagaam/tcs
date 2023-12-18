<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GanttController extends Controller
{
    public function get($id){
        $tasks = new Task();
        $student = Student::with('tasks')->where('user_id', $id)->first();
        $tasks = $student->tasks;

        return response()->json([
            "data" => $tasks->all()
        ]);
    }
}
