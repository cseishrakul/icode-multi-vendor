<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class NewletterController extends Controller
{
    public function addSubscriber(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $subscribersCount = NewsletterSubscriber::where('email', $data['subscriber_email'])->count();
            if ($subscribersCount > 0) {
                return "Exists";
            } else {
                $subscriber = new NewsletterSubscriber;
                $subscriber->email = $data['subscriber_email'];
                $subscriber->status = 1;
                $subscriber->save();
                return "Saved";
            }
        }
    }
}
