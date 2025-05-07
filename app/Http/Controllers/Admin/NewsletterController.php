<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Subscribers;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    use Searchable;
    //
    public function index(): View
    {
        $query = Subscribers::query();

        $this->search($query, ['email', 'created_at']);

        $subscribers = $query->latest()->paginate(10);
        return view('admin.newsletters.index', compact('subscribers'));
    }

    public function destroy(string $id)
    {
        try {
            Subscribers::findorfail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);

            return response(['message' => 'Something Went Wrong! Please Try Again'], 500);
        }
    }


    public function sendMail(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required'],
        ]);

        $subscribers = Subscribers::all();

        foreach ($subscribers as $key => $subscriber) {
            # code...
            Mail::to($subscriber->email)->send(new NewsletterMail($request->subject,$request->message));
        }

        Notify::successNotification('Newsletter sent Successfully!');
        return redirect()->back()->with('success','Newsletter Sent');

    }
}
