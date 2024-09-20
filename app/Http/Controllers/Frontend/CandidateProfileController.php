<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateBasicProfileUpdateRequest;
use App\Models\Candidate;
use App\Models\Experience;
use App\Models\Profession;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateProfileController extends Controller
{
    //
    use FileUploadTrait;

    function index(): View
    {
        $experiences = Experience::all();
        $professions = Profession::all();
        $candidate = Candidate::where('user_id',auth()->user()->id)->first();
        return view('frontend.candidate-dashboard.profile.index', compact('candidate','experiences','professions'));
    }

    /***
     *
     * Update basic info
     *
     */
    function basicInfoUpdate(CandidateBasicProfileUpdateRequest $request): RedirectResponse
    {

        /***
         *
         *
         * Handle files
         * 
         */

        $imagePath = $this->uploadFile($request, 'profile_picture');
        $cvPath = $this->uploadFile($request, 'cv');

        $data = [];
        if (!empty($imagePath)) $data['image'] = $imagePath;
        if (!empty($cvPath)) $data['cv'] = $cvPath;
        $data['full_name'] = $request->full_name;
        $data['title'] = $request->title;
        $data['experience_id'] = $request->experience_level;
        $data['website'] = $request->website;
        $data['birth_date'] = $request->date_of_birth;


        /***
         * update data
         */
        // dd($request->all());
        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $data
        );
        Notify::updatedNotification();
        return redirect()->back();
    }
}
