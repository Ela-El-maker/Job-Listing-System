<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CandidateJobBookmarkController extends Controller
{
    //
    function save(string $id)
    {
        // Save the candidate's bookmark for the given job ID
        // Implement the logic to save the bookmark

        if (!auth()->check()) {
            throw ValidationException::withMessages(['Please login first to bookmark this job.']);
        }
        if (auth()->check() && auth()->user()->role !== 'candidate') {
            throw ValidationException::withMessages(['Only candidates are allowed to bookmark']);
        }

        $alreadyBookmarked = JobBookmark::where(['job_id' => $id, 'candidate_id' => auth()->user()->candidateProfile->id])->exists();
        if ($alreadyBookmarked) {
            throw ValidationException::withMessages(['You have already bookmarked this job.']);
        }

        $bookmark = new JobBookmark();
        $bookmark->job_id = $id;
        $bookmark->candidate_id = auth()->user()->candidateProfile->id;
        $bookmark->save();

        return response(['message' => 'Bookmark saved successfully!', 'id' => $id], 200);
    }


    function index(): View
    {
        $bookmarks = JobBookmark::where('candidate_id', auth()->user()->candidateProfile->id)->paginate(15);
        return view('frontend.candidate-dashboard.bookmarks.index', compact('bookmarks'));
    }
}
