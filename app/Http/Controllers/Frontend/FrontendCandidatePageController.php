<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCandidatePageController extends Controller
{
    //
    // function index(Request $request): View
    // {
    //     // dd($request);
    //     $skills = Skill::all();
    //     $experience = Experience::all();
    //     $query = Candidate::query();
    //     $query->where(['profile_complete' => 1, 'visibility' => 1]);
    //     $candidates = $query->paginate(21);

    //     if ($request->has('skills') && $request->filled('skills')) {

    //         $ids = Skill::whereIn('slug', $request->skills)->pluck('id')->toArray();
    //         dd($ids);
    //         $query->whereHas('skills', function ($subquery) use ($ids) {
    //             $subquery->whereIn('skill_id', $ids);
    //         });
    //     }

    //     return view('frontend.pages.candidate-index', compact('candidates', 'skills', 'experience'));
    // }

    function index(Request $request): View
    {
        $skills = Skill::all();
        $experience = Experience::all();
        $query = Candidate::query();

        // Base query for profile completion and visibility
        $query->where(['profile_complete' => 1, 'visibility' => 1]);

        // Filter by skills
        if ($request->has('skills') && $request->filled('skills')) {
            $ids = Skill::whereIn('slug', $request->skills)->pluck('id')->toArray();
            $query->whereHas('skills', function ($subquery) use ($ids) {
                $subquery->whereIn('skill_id', $ids);
            });
        }

        // Filter by experience
        if ($request->has('experience') && $request->filled('experience')) {
            $query->where('experience_id', $request->experience);
        }

        // Paginate results
        $candidates = $query->paginate(21);

        return view('frontend.pages.candidate-index', compact('candidates', 'skills', 'experience'));
    }


    function show(string $slug): View
    {
        $candidate = Candidate::where(['profile_complete' => 1, 'visibility' => 1, 'slug' => $slug])->firstOrFail();

        return view('frontend.pages.candidate-details', compact('candidate'));
    }
}
