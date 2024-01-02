<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('pages.student_pages.profile.index');
    }

    public function edit(Student $profile) {
        return view('pages.student_pages.profile.edit');
    }

    public function update(Student $profile, Request $request) {
        $request->validate([
            'profile_picture' => 'required'
        ]);

        $image = $request->profile_picture;

        if (isset($image)) {
            $extension = $image->extension();
            $newImage = $request->profile_picture->storeAs('profile', "$profile->id.$extension", 'public');

            $profile->update(['profile_picture' => $newImage]);
        }

        return redirect()->route('profile.index')->with('toastData', ['status' => 'success', 'message' => "Image Updated"]);
    }
}
