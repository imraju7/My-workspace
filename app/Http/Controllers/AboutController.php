<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'About-us',
            'businessName' => $setting->business_name ?? 'JobFitts',
            'about_text' => $setting->about_text ?? 'About',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
        ];
        return view('about', compact('data'));
    }
}
