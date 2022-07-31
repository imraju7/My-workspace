<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Homepage',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg'
        ];
        return view('about', compact('data'));
    }
}
