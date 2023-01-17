<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function showAllBlogs()
    {
        // $blogs = Blog::all();
        $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
        ->select('blogs.*', 'users.name as user_id' )
        ->get();
        // return $blogs;
        // dd($blogs);
        // echo "<pre>";
        // print_r($blogs);

        return view('blogs', ['blogs' => $blogs]);
    }
}
