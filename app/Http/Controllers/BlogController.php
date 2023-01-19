<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\category;
use App\Models\Blog_cat_relation;

class BlogController extends Controller
{
    public function showAllBlogs()
    {
        // $blogs = Blog::all();
        $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
        ->select('blogs.*', 'users.name as user_id' )
        ->get();
        $categories = category::all();
        return view('blogs', ['blogs' => $blogs, 'categories' => $categories]);
    }

    public function addNewBlog(Request $req)
    {
        $req->validate([
            'blogName' => 'required',
            'blogDescr' => 'required',
            'checkCategory' => 'required',
            'blogImage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $blog = new Blog();
        $selectedCategories = $req->checkCategory;
        $file = $req->file('blogImage');
        // $ext = $file->getClientOriginalExtension();
        // $blogImage = time() . '.' . $ext;
        $blogImage = $file->getClientOriginalName();
        $file->storeAs('public/blogImages/', $blogImage);
        $blog->user_id = session('userId');
        $blog->title = $req->blogName;
        $blog->description = $req->blogDescr;
        $blog->image = $blogImage;
        $blog->status = 1;
        $blog->save();
        $blogId = $blog->id;
        // code to insert selected categories in blog_cat_relations table.
        if (is_array($selectedCategories) && count($selectedCategories) > 0) {
            foreach ($selectedCategories as $selectedCategory) {
                $blogCatRelation = new Blog_cat_relation();
                $catId = (int)$selectedCategory;
                $blogCatRelation->blog_id = $blogId;
                $blogCatRelation->category_id = $catId;
                $blogCatRelation->save();
            }
        }
        $req->session()->flash("message", "Blog Added successfull");
        return redirect('blogs');
    }
}
