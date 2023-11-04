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

            $pendingReports = Report::whereIn('group_code', $groupCodes)->where('status', 1)->paginate(10);
            $reportsList = Report::whereIn('group_code', $groupCodes)->where('status', '!=', 1)->paginate(10);
        } else {
            $pendingReports = Report::where('status', 1)->paginate(10);
            $reportsList = Report::where('status', '!=', 1)->paginate(10);
        }

        return view('pages.reports.index', compact('pendingReports', 'reportsList'));
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

        if ($request->validated('document')) {
            $name = $request->validated('document')->getClientOriginalName();
            $storedFile = $request->validated('document')->storeAs("files", $name, 'public');
        }

        Report::create([
            'document_path' => $storedFile ?? null,
            'status' => 1,
            ...$request->validated()
        ]);

        return redirect()->route('reports.index');
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
