<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = auth()->user()->roles;

        $students = Student::whereHas('user', function($q) {
            $q->withoutTrashed();
        })->paginate();
        
        return view('pages.admin_pages.students.index', compact(['roles', 'students']));
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
        $roles = auth()->user()->roles;
        $student = DB::table('students')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->where('students.user_id', $id)->get()->first();
        // dd($student);
        
        return view('pages.admin_pages.students.show', compact(['roles','student']));
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
