<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (Auth::check()) {
            $data = [
                'pageTitle' => 'About-us',
                'businessName' => $setting->business_name ?? 'JobFitts',
                'about_text' => $setting->about_text ?? 'About',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'setting' => $setting,
                'initial_count' => auth()->user()->customer ? Application::whereIn('vacancy_id', Vacancy::where('customer_id', auth()->user()->customer->id)->pluck('id'))->count() : 0
            ];
        } else {
            $data = [
                'pageTitle' => 'About-us',
                'businessName' => $setting->business_name ?? 'JobFitts',
                'about_text' => $setting->about_text ?? 'About',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'setting' => $setting,
                'initial_count' => 0
            ];
        }
        return view('about', compact('data'));
    }
}
