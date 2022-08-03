<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Homepage',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
        ];
        if ($user->role->name == 'customer') {
            $profile = [
                'name' => $user->name,
                'email' => $user->email,
                'company_name' => $user->customer->company_name,
                'company_description' => $user->customer->company_description,
                'company_phone' => $user->customer->company_phone,
                'company_email' => $user->customer->company_email,
                'company_address' => $user->customer->company_address,
                'designation' => $user->customer->designation
            ];
        } else {
            $profile = [
                'name' => $user->name,
                'email' => $user->email
            ];
        }
        return view('profile', compact('data', 'profile'));
    }

    public function edit(Request $request)
    {
    }

    public function resetPassword(Request $request)
    {
    }
}
