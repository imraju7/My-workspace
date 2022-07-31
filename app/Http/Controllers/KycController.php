<?php

namespace App\Http\Controllers;

use App\Models\CompanyType;
use Illuminate\Http\Request;
use App\Models\Setting;

class KycController extends Controller
{
    public function customer_index()
    {
        $setting = Setting::first();
        $companyTypes = CompanyType::all();
        $data = [
            'pageTitle' => 'Login',
            'logo' => $setting->getFirstMedia()->getUrl('logosize'),
            'favicon' => $setting->getFirstMedia()->getUrl('favicon'),
            'companyTypes' => $companyTypes
        ];
        return view('customer-kyc', compact('data'));
    }

    public function candidate_index()
    {
        $setting = Setting::first();
        $companyTypes = CompanyType::all();
        $data = [
            'pageTitle' => 'Login',
            'logo' => $setting->getFirstMedia()->getUrl('logosize'),
            'favicon' => $setting->getFirstMedia()->getUrl('favicon'),
            'companyTypes' => $companyTypes
        ];
        return view('candidate-kyc', compact('data'));
    }
}
