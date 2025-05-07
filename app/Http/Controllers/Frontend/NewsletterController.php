<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribers;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //

    function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = new Subscribers();
        $subscriber->email = $request->email;
        $subscriber->save();

        // Return success response
        return response([
            'success' => true,
            'message' => 'You have successfully subscribed to the newsletter!'
        ]);

    }
}
