<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendBlogPageController extends Controller
{
    use Searchable;

    public function index(): View
    {
        $query = Blog::query();

        $this->search($query, ['title', 'created_at', 'updated_at']);

        $blogs = $query->where('status', 1)->latest()->paginate(10);

        $featured = Blog::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->take(10)->get();
        return view('frontend.pages.blog-index', compact('blogs', 'featured'));
    }

    public function show(string $slug): View
    {
        // Implement your blog show logic here and return the view with the data
        $blog = Blog::where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.blog-details', compact('blog'));
    }
}
