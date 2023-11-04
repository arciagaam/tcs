<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login.index');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        if(auth()->attempt($request->validated())) {

            if(checkRole(auth()->user(), [5])) {
                return redirect()->route('home.index');
            }
            
            if(checkRole(auth()->user(), [2,3,4])) {
                return redirect()->route('dashboard.index');
            }
            
            return redirect('/');
        }

        return redirect()->route('login')->with('error', 'Invalid username or password');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
