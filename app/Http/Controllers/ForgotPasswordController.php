<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordStepOneRequest;
use App\Http\Requests\ForgotPasswordStepThreeRequest;
use App\Http\Requests\ForgotPasswordStepTwoRequest;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class ForgotPasswordController extends Controller
{

    public function stepOne() {
        session()->forget('forgot_password');
        return view('pages.forgot_password.step-one');
    }

    public function postStepOne(ForgotPasswordStepOneRequest $request) {

        $code = rand(100000, 999999);

        User::where('email', $request->validated('email'))->update(['request_code' => $code]);

        Mail::to($request->validated('email'))
        ->queue(new ForgotPassword($code));

        session(['forgot_password.email' => $request->validated('email')]);
        return redirect()->route('forgot-password.step-two');
    }

    public function stepTwo() {
        if(!session('forgot_password')) {
            return redirect()->route('forgot-password.post.step-one');
        }
        return view('pages.forgot_password.step-two');
    }

    public function postStepTwo(ForgotPasswordStepTwoRequest $request) {
        $validateUser = User::where('email', session('forgot_password.email'))->where('request_code', $request->validated('code'))->first();

        if($validateUser) {
            session(['forgot_password.user' => $validateUser]);
            return redirect()->route('forgot-password.step-three');
        }

        return back()->with('error', 'Invalid Code');
    }

    public function stepThree() {
        if(!session('forgot_password')) {
            return redirect()->route('forgot-password.post.step-one');
        }
        return view('pages.forgot_password.step-three');
    }

    public function postStepThree(ForgotPasswordStepThreeRequest $request) {
        $user = session('forgot_password.user');
        $user->update(['password' => bcrypt($request->validated('new_password'))]);
        session()->forget('forget_password');
        return view('pages.forgot_password.success');
    }

}
