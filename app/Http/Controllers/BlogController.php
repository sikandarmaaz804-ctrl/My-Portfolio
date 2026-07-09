<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER BLOG LIST
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('blog', compact('blogs'));
    }

    /*
    |--------------------------------------------------------------------------
    | BLOG POPUP (AJAX MODAL)
    |--------------------------------------------------------------------------
    */
    public function popup($id)
    {
        $blog = Blog::with('comments')->findOrFail($id);

        return view('blog-popup', compact('blog'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE COMMENT (AJAX)
    |--------------------------------------------------------------------------
    */
    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string'
        ]);

        Comment::create([
            'blog_id' => $id,
            'name' => $request->name,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN STORE BLOG
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'description' => 'required'
        ]);

        $uploadPath = public_path('uploads/blogs');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $extension = strtolower($request->file('image')->getClientOriginalExtension());
        $baseName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
        $imageName = now()->format('YmdHis') . '_' . Str::slug($baseName) . '.' . $extension;
        $request->file('image')->move($uploadPath, $imageName);

        // Save blog
        Blog::create([
            'title' => $request->title,
            'image' => 'blogs/' . $imageName,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blogs')
                         ->with('success', 'Blog created successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN BLOG LIST
    |--------------------------------------------------------------------------
    */
    public function adminIndex()
    {
        $blogs = Blog::latest()->get();
        return view('admin.all-blog', compact('blogs'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN UPLOADS PAGE
    |--------------------------------------------------------------------------
    */
    public function uploads()
    {
        $blogs = Blog::latest()->get();
        return view('admin.uploads', compact('blogs'));
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE BLOG
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // delete image safely
        $imagePath = public_path('uploads/' . $blog->image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully!');
    }
}
