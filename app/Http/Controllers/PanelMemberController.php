<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePanelMemberRequest;
use App\Models\StudentFile;
use App\Models\User;
use Illuminate\Http\Request;

class PanelMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = auth()->user()->student;
        $ta = $student->files->filter(fn($value) => ($value->status == 2 && $value->to_role_id == 2))->values()->first();
        $te = $student->files->filter(fn($value) => ($value->status == 2 && $value->to_role_id == 3))->values()->first();
        $se = $student->files->filter(fn($value) => ($value->status == 2 && $value->to_role_id == 4))->values()->first();

        $ta = User::find($ta->to_user_id ?? 0) ?? null;
        $te = User::find($te->to_user_id ?? 0) ?? null;
        $se = User::find($se->to_user_id ?? 0) ?? null;

        return view('pages.student_pages.teachers.index', compact('ta', 'te', 'se'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::with(['roles' => function($query) {$query->whereIn('roles.id', [2,3,4]);}])->get()->filter(fn($value) => count($value->roles));
        $taTeachers = $teachers->filter(fn($value) => $value->roles->contains(2));
        $teTeachers = $teachers->filter(fn($value) => $value->roles->contains(3));
        $seTeachers = $teachers->filter(fn($value) => $value->roles->contains(4));

        $student = auth()->user()->student;
        $check = [];
        foreach($student->files as $file) {
            $check[$file->to_role_id] = $file;
        }
        return view('pages.student_pages.teachers.create', compact('taTeachers', 'teTeachers', 'seTeachers', 'check'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePanelMemberRequest $request)
    {

        $files = [
            ['to_role' => 2, 'file' => $request->validated('ta_iso'), 'user_id' => $request->validated('ta_user_id')],
            ['to_role' => 3, 'file' => $request->validated('te_iso'), 'user_id' => $request->validated('te_user_id')],
            ['to_role' => 4, 'file' => $request->validated('se_iso'), 'user_id' => $request->validated('se_user_id')],
        ];

        $files = collect($files)->filter(fn($value) => $value['file']!=null)->values();

        foreach($files as $index => $uploadedFile) {
            $name = $uploadedFile['file']->getClientOriginalName();
            $storedFile = $uploadedFile['file']->storeAs("files", $name, 'public');
            
            StudentFile::create([
                'student_id' => auth()->user()->student->id,
                'to_user_id' => $uploadedFile['user_id'],
                'to_role_id' => $uploadedFile['to_role'],
                'path' => $storedFile
            ]);
        }

        return redirect()->route('panel-members.index');
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
