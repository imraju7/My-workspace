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
            'logo' => $setting->getFirstMedia()->getUrl('logosize'),
            'favicon' => $setting->getFirstMedia()->getUrl('favicon')
        ];
        return view('about', compact('data'));
    }
}
