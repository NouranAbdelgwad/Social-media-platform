<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogInController extends Controller
{
    public function index(){
        return view("registeration.log_in");
    }
public function check(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return redirect('/');
    }
    return back()->withErrors([
        'email' => "The provided credentials don't match our records.",
    ])->withInput($request->only('email')); // Preserve the email input
}


}
