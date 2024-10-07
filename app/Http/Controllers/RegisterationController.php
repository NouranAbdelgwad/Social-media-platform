<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RegisterationController extends Controller
{
    public function index(){
        return view("registeration.sign_up");
    }
    public function store(Request $request){
        $validatedUser = $request->validate([
            "name"=>"required|string|min:2|max:255",
            "email"=>"required|email|unique:users|max:255",
            "password"=>"required|string|min:8|confirmed"
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect("/");
    }

    public function uploadImage(FacadesRequest $request)
    {
        // $request->validate([
        //     "picture_path" => "required|image|mimes:png,jpg,jpeg,webp,gif|max:2048",
        // ]);
        if ($request::hasFile("picture_path")) {
            $picturePath = $request::file('picture_path')->store('assets/images', 'public');
            $user = Auth::user();
            User::findOrFail($user->id)->update([
                "picture_path" => $picturePath
            ]);
            return redirect("/")->with('success', 'Profile image updated successfully.');
        }
        return back()->with('error', 'Image upload failed.');
    }

}
