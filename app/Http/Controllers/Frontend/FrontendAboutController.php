<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\ClientReview;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendAboutController extends Controller
{
    //
    public function index() : View
    {
        $about = About::first();
        $clientReviews = ClientReview::all();
        $blogs = Blog::latest()->take(6)->get();
        return view('frontend.pages.about-page', compact('about','clientReviews','blogs'));
    }
}
