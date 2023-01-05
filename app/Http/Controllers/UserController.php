<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            "email" => "required",
            "upass" => "required | min : 5"
        ]);
        $userDetails = $req->input();
        $userDetailsDB = User::where("email", $userDetails['email'])->first();
        if (!empty($userDetailsDB)) {
            if (Hash::check($userDetails['upass'], $userDetailsDB['password']))
            {
                $req->session()->put('userEmail', $userDetails['email']);
                $req->session()->flash('login', true);
                return redirect('dashboard');
            } else {
                // return redirect('signup')->with('message', 'Password wrong. Please try again');
                return Redirect::back()->withErrors(['msg' => "Password wrong."]);
            }
        } else {
            // return redirect('signup')->with('message', 'User email not found.');
            return Redirect::back()->withErrors(['msg' => "User email not found"]);

        }
    }

    public function register(Request $req)
    {
        $req->validate([
            "uname" => "required | min : 5 | max : 20",
            "email" => "required",
            "upass" => "required | min : 5",
            "cpass" => "required | min : 5",
            "profileImage" => "required"
        ]);
        $userDetails = $req->input();
        // $color = "danger";
        if ($userDetails['upass'] !== $userDetails['cpass']) {
            // $req->session()->flash("message" , "Password didn't matched");
            // return redirect("signup");
            return Redirect::back()->withErrors(['msg' => "Password din't matched"]);
        }
        // $color = "success";
        $req->session()->flash("message", "Registration successfull");
        // $req->session()->put("userEmail", $userDetails['email']);
        $user = new User();
        $user->name = $userDetails['uname'];
        $user->email = $userDetails['email'];
        $user->password = Hash::make($userDetails['upass']);
        // $img = $req->file('profileImage')->store('img');
        $file = $req->file('profileImage');
        $ext = $file->getClientOriginalExtension();
        $img = time().'.'.$ext;
        $file->move('uploads/images', $img);
        $user->profile_pic = $img;
        $user->save();
        return redirect("signup");

    }

    public function logout()
    {
        if (session()->has("userEmail")) {
            session()->pull("userEmail", null);
        }
        // return redirect('signup');
        auth::logout();
        return redirect('signup');
    }

    public function dashboard() 
    {
        $users = User::all();
        return view('dashboard', ['users' => $users]);
    }

}
