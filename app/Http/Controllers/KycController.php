<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CompanyType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Setting;

class KycController extends Controller
{
    public function customer_index()
    {
        $setting = Setting::first();
        $companyTypes = CompanyType::all();
        $data = [
            'pageTitle' => 'kyc',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'companyTypes' => $companyTypes,
            'setting' => $setting
        ];
        return view('customer-kyc', compact('data'));
    }

    public function customer_verify(Request $request)
    {
        $this->validate($request, [
            'designation' => 'required|string',
            'company_type_id' => 'required',
            'company_name' => 'required|string',
            'company_description' => 'required|string',
            'company_phone' => 'required',
            'company_email' => 'required|email',
            'company_address' => 'required'
        ]);

        Customer::create([
            'user_id' => auth()->user()->id,
            'designation' => $request->designation,
            'company_type_id' => $request->company_type_id,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'company_phone' => $request->company_phone,
            'company_email' => $request->company_email,
            'company_address' => $request->company_address
        ]);

        return redirect()->route('homepage');
    }

    public function candidate_index()
    {
        $setting = Setting::first();
        $companyTypes = CompanyType::all();
        $data = [
            'pageTitle' => 'kyc',
            'logo' => $setting->getFirstMedia()->getUrl('logosize'),
            'favicon' => $setting->getFirstMedia()->getUrl('favicon'),
            'companyTypes' => $companyTypes,
            'setting' => $setting
        ];
        return view('candidate-kyc', compact('data'));
    }

    public function candidate_verify(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|string'
        ]);

        Candidate::create([
            'user_id' => auth()->user()->id,
            'address' => $request->address
        ]);

        return redirect()->route('homepage');
    }
}
