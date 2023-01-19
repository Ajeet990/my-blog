<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
                $req->session()->put('userId', $userDetailsDB['id']);
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
            "email" => "required | unique:users,email",
            "upass" => "required | min : 5",
            "cpass" => "required | min : 5",
            "profileImage" => "required|image|mimes:jpg,jpeg,png,gif|max:2048"
        ]);
        $userDetails = $req->input();
        if ($userDetails['upass'] !== $userDetails['cpass']) {
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
        $users = User::paginate(5);
        return view('dashboard', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        // return $user;
        return view('edit', ['user' => $user]);

    }

    public function update(Request $req, $id)
    {
        // $file = $req->file('profileImage');
        // $ext = $file->getClientOriginalExtension();
        // $updated_image = $img = time().'.'.$ext;
        // $file->move('uploads/images', $img);
        // User::where('id', $id)->update([
        //     "name" => $req->uname,
        //     "email" => $req->email,
        //     "profile_pic" => $updated_image
        // ]);
        // return redirect('dashboard');
        $user = User::find($id);
        $user->name = $req->uname;
        $user->email = $req->email;
        if ($req->hasFile('profileImage')) {
            $destination = 'uploads/images/'.$req->profile_pic;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $req->file('profileImage');
            $ext = $file->getClientOriginalExtension();
            // return $ext;
            $image = time().'.'.$ext;
            $file->move('uploads/images/', $image);
            $user->profile_pic = $image;
        }
        $user->update();
        return redirect('dashboard');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect('dashboard');
    }

}
