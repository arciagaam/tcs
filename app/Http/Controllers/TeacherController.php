<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherStoreRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $teachers = User::whereHas('roles', function($q){
            $q->whereIn('roles.id', [2,3,4]);
        })
        ->when(request()->search, function($query) {
            $query->whereRaw('CONCAT(users.first_name, " ", users.middle_name, " ", users.last_name) like ?', [request()->search."%"])
            ->orWhereRaw('CONCAT(users.first_name," ", users.last_name) like ?', [request()->search."%"])
            ->orWhere('users.first_name', 'like', request()->search . '%')
            ->orWhere('users.middle_name', 'like', request()->search . '%')
            ->orWhere('users.last_name', 'like', request()->search . '%')
            ->orWhere('users.email', 'like', request()->search . '%');
        })
        ->paginate(20);

        return view('pages.teachers.index', compact('teachers'));
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
    public function store(TeacherStoreRequest $request)
    {
        $user = User::create($request->safe()->except('confirm_password', 'roles'));
        $roleIds = collect($request->validated('roles'))->map(fn ($value) => $value);
        $user->roles()->attach($roleIds);

        return redirect()->route('teachers.index');
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
    public function edit(User $teacher)
    {
        $teacher = $teacher->where('id', $teacher->id)->with('roles')->first();
        return view('pages.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $teacher)
    {
        $teacher->update($request->post());
        return redirect()->route('teachers.edit', ['teacher' => $teacher->id])->with('toastData', ['status' => 'success', 'message' => "Teacher updated!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher)
    {
        $teacher->delete();
        return back()->with('toastData', ['status' => 'success', 'message' => "Teacher successfully deleted"]);

    }
}
