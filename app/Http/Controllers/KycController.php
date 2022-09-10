<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CompanyType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function customer_index()
    {
        $setting = Setting::first();
        $companyTypes = CompanyType::all();
        if (Auth::check()) {
            $data = [
                'pageTitle' => 'kyc',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'companyTypes' => $companyTypes,
                'setting' => $setting,
                'initial_count' => auth()->user()->role->name == 'customer' ? Application::whereIn('vacancy_id', Vacancy::where('customer_id', auth()->user()->customer->id)->pluck('id'))->count() : 0
            ];
        } else {
            $data = [
                'pageTitle' => 'kyc',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'companyTypes' => $companyTypes,
                'setting' => $setting,
                'initial_count' => 0
            ];
        }
        return view('customer-kyc', compact('data'));
    }

    public function customer_verify(Request $request)
    {
        $this->validate($request, [
            'designation' => 'required|string',
            'company_type_id' => 'required',
            'company_name' => 'required|string|unique:customers,company_name',
            'company_description' => 'required|string',
            'company_phone' => 'required|numeric',
            'company_email' => 'required|email|unique:customers,company_email',
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

        return redirect()->route('homepage')->with('success', 'You have unlocked the full potential by verifying your information. Enjoy Hiring !');
    }

    public function candidate_index()
    {
        $setting = Setting::first();
        $companyTypes = CompanyType::all();
        if (Auth::check()) {
            $data = [
                'pageTitle' => 'kyc',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'companyTypes' => $companyTypes,
                'setting' => $setting,
                'initial_count' => auth()->user()->role->name == 'customer' ? Application::whereIn('vacancy_id', Vacancy::where('customer_id', auth()->user()->customer->id)->pluck('id'))->count() : 0
            ];
        } else {
            $data = [
                'pageTitle' => 'kyc',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'companyTypes' => $companyTypes,
                'setting' => $setting,
                'initial_count' => 0
            ];
        }
        return view('candidate-kyc', compact('data'));
    }

    public function candidate_verify(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|string',
            'skills' => 'required|string'
        ]);

        Candidate::create([
            'user_id' => auth()->user()->id,
            'address' => $request->address,
            'skills' => $request->skills,
            'educational_qualifications' => $request->educational_qualifications
        ]);

        return redirect()->route('homepage')->with('success', 'You just unlocked the feature to apply for the jobs you like !');
    }
}
