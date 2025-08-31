<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Rules\CustomRecaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Blog\app\Models\Blog;
use Modules\Blog\app\Models\BlogCategory;
use Modules\Blog\app\Models\BlogComment;

class BlogController extends Controller
{
    function index(Request $request) {
        // Validate and sanitize input parameters
        $validated = $request->validate([
            'search' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s\-_.,!?]+$/',
            'category' => 'nullable|string|max:100|alpha_dash'
        ]);
        
        $search = $validated['search'] ?? null;
        $category = $validated['category'] ?? null;
        
        $query = Blog::query();
        $query->when($search, function($query) use ($search) {
            $sanitizedSearch = strip_tags(trim($search));
            $query->whereHas('translation', function($query) use ($sanitizedSearch) {
                $query->where('title', 'like', '%' . $sanitizedSearch . '%')
                    ->orWhere('description', 'like', '%' . $sanitizedSearch . '%');
            });
        });
        $query->when($category, function($query) use ($category) {
            $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });
        $query->whereHas('category', function($q) { $q->where('status', 1); });
        $blogs = $query->where(['status' => 1])->orderBy('created_at', 'desc')->paginate(9);

        $categories = BlogCategory::where('status', 1)->get();
        $popularBlogs = Blog::where(['status' => 1])->whereHas('category', function($q) { $q->where('status', 1); })->where('is_popular', 1)->orderBy('created_at', 'desc')->limit(8)->get();
        return view('frontend.pages.blog', compact('blogs', 'categories', 'popularBlogs'));
    }

    function show(string $slug) {
       $blog = Blog::where('slug', $slug)->whereHas('category', function($q) { $q->where('status', 1); })->firstOrFail();
       $latestBlogs = Blog::where(['status' => 1])->where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->limit(8)->get();
       $categories = BlogCategory::where('status', 1)->get();
       $comments = BlogComment::where(['blog_id' => $blog->id])->where('status', 1)->orderBy('created_at', 'desc')->get();

       return view('frontend.pages.blog-details', compact('blog', 'latestBlogs', 'categories', 'comments'));
    }

    function submitComment(Request $request) {
       $request->validate([
        'comment' => ['required', 'max:1000'], 
        'g-recaptcha-response' => Cache::get('setting')->recaptcha_status == 'active' ? ['required', new CustomRecaptcha()] : 'nullable',
       ], [
        'comment.required' => __('The comment field is required'),
        'comment.max' => __('The comment must not be greater than 1000 characters'),
        'g-recaptcha-response.required' => __('The reCAPTCHA verification is required'),
        'g-recaptcha-response.recaptcha' => __('The reCAPTCHA verification failed'),
       ]);
       $comment = new BlogComment();

       $comment->blog_id = $request->blog_id;
       $comment->user_id = userAuth()->id;
       $comment->comment = $request->comment;
       $comment->save();
       return redirect()->back()->withFragment('comments')->with(['messege' => __('Comment added successfully. waiting for approval'), 'alert-type' => 'success']);
    }
}
