<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Contact-us',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
            'setting' => $setting
        ];
        return view('contact', compact('data'));
    }
}
