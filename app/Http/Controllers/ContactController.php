<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (Auth::check()) {
            $data = [
                'pageTitle' => 'Contact-us',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'setting' => $setting,
                'initial_count' => auth()->user()->role->name == 'customer' ? Application::whereIn('vacancy_id', Vacancy::where('customer_id', auth()->user()->customer->id)->pluck('id'))->count() : 0
            ];
        } else {
            $data = [
                'pageTitle' => 'Contact-us',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'setting' => $setting,
                'initial_count' => 0
            ];
        }
        return view('contact', compact('data'));
    }

    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        Contact::create([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Thank you for contacting us. We will get back to you soon');
    }
}
