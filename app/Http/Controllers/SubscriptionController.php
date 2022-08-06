<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\CompanyType;
use App\Models\Vacancy;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        Subscriber::create([
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'Subscribed to our Mailing List successfully.');
    }

    public function test()
    {
        if(Vacancy::first()->hasApplied)
        {
            return 'applied';
        }
        else{
            return 'not applied';
        }
        return Vacancy::first()->hasApplied;
    }
}
