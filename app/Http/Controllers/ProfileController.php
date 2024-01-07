<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('pages.student_pages.profile.index');
    }

    public function edit(Student $profile) {
        return view('pages.student_pages.profile.edit');
    }

    public function update(Student $profile, UpdateProfileRequest $request) {
        $image = $request->profile_picture;

        if (isset($image)) {
            $extension = $image->extension();
            $newImage = $request->profile_picture->storeAs('profile', "$profile->id.$extension", 'public');

            $profile->update(['profile_picture' => $newImage]);
        }

        User::where('id', $profile->user_id)->update($request->safe()->only(['first_name', 'middle_name', 'last_name', 'email']));
        $profile->update($request->safe()->except(['first_name', 'middle_name', 'last_name', 'email', 'profile_picture']));
        return redirect()->route('profile.index')->with('toastData', ['status' => 'success', 'message' => "Profile Updated"]);
    }
}
