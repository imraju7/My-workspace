<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class KycController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Login',
            'logo' => $setting->getFirstMedia()->getUrl('logosize'),
            'favicon' => $setting->getFirstMedia()->getUrl('favicon')
        ];
        return view('kyc',compact('data'));
    }
}
