<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Models\Report;
use App\Models\Student;
use App\Models\TeacherStudent;
use App\Models\UserRole;
use Illuminate\Http\Request;

class ReportController extends Controller
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

            $pendingReports = Report::whereIn('group_code', $groupCodes)->whereIn('user_role_id', $teacherIds)->where('status', 1)->paginate(10);
            $reportsList = Report::whereIn('group_code', $groupCodes)->whereIn('user_role_id', $teacherIds)->where('status', '!=', 1)->paginate(10);
        } else {
            $pendingReports = Report::where('status', 1)->paginate(10);
            $reportsList = Report::where('status', '!=', 1)->paginate(10);
        }

        $panels = null;

        if(checkRole(auth()->user(), [5])) {
            $student = auth()->user()->student;
            $ta = $student->files->filter(fn($value) => ($value->status == 2 && $value->to_role_id == 2))->values()->first();
            $te = $student->files->filter(fn($value) => ($value->status == 2 && $value->to_role_id == 3))->values()->first();
            $se = $student->files->filter(fn($value) => ($value->status == 2 && $value->to_role_id == 4))->values()->first();
            
            $ta = UserRole::where('user_id', $ta->to_user_id ?? null)->where('role_id', $ta->to_role_id ?? null)->with('user')->first() ?? null;
            $te = UserRole::where('user_id', $te->to_user_id ?? null)->where('role_id', $te->to_role_id ?? null)->with('user')->first() ?? null;
            $se = UserRole::where('user_id', $se->to_user_id ?? null)->where('role_id', $se->to_role_id ?? null)->with('user')->first() ?? null;
            
            $panels = ['Thesis Adviser' => $ta, 'Technical Editor' => $te, 'System Expert' => $se];
        }

        return view('pages.reports.index', compact('pendingReports', 'reportsList', 'panels'));
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
    public function store(ReportStoreRequest $request)
    {
        if(checkRole(auth()->user(), [5]) && !$request->validated('panel')) {
            return back()->with('toastData', ['status' => 'error', 'message' => "Select a panel"]);
        }

        if ($request->validated('document')) {
            $name = $request->validated('document')->getClientOriginalName();
            $storedFile = $request->validated('document')->storeAs("files", $name, 'public');
        }

        Report::create([
            'document_path' => $storedFile ?? null,
            'status' => 1,
            'user_role_id' => $request->validated('panel'),
            ...$request->validated()
        ]);

        return redirect()->route('reports.index')->with('toastData', ['status' => 'success', 'message' => "Report submitted"]);;
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $report->update(['status' => $request->verdict == 1 ? 2 : 3]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
