<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\VerifyUserMail;
use App\Models\Group;
use App\Models\Student;
use App\Models\StudentFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index() {
        $teachers = User::with(['roles' => function($query) {$query->whereIn('roles.id', [2,3,4]);}])->get()->filter(fn($value) => count($value->roles));
        
        $taTeachers = $teachers->filter(fn($value) => $value->roles->contains(2));
        $teTeachers = $teachers->filter(fn($value) => $value->roles->contains(3));
        $seTeachers = $teachers->filter(fn($value) => $value->roles->contains(4));

 
        return view('pages.register.index', compact('taTeachers', 'teTeachers', 'seTeachers'));
    }

    public function register(RegisterRequest $request) {
        $user = User::create($request->safe()->except(['group_code', 'year', 'section']));
        $student = Student::create([
            'user_id' => $user->id,
            ...$request->safe()->only(['year', 'section', 'group_code'])
        ]);


        $user->roles()->attach([5]);

        $files = [
            ['file' => $request->validated('ta_iso'), 'user_id' => $request->validated('ta_user_id')],
            ['file' => $request->validated('te_iso'), 'user_id' => $request->validated('te_user_id')],
            ['file' => $request->validated('se_iso'), 'user_id' => $request->validated('se_user_id')],
        ];

        foreach($files as $index => $uploadedFile) {
            $name = $uploadedFile['file']->getClientOriginalName();
            $storedFile = $uploadedFile['file']->storeAs("files", $name, 'public');
            
            StudentFile::create([
                'student_id' => $student->id,
                'to_user_id' => $uploadedFile['user_id'],
                'to_role_id' => $index+2,
                'path' => $storedFile
            ]);
        }

        Mail::to($request->validated('email'))->queue(new VerifyUserMail(formatName($user), $user->id));
        return redirect()->route('login')->with('toastData', ['status' => 'success', 'message' => "Account registered."]);
    }
}
