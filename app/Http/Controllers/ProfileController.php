<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Application;
use App\Models\Vacancy;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Profile',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'setting' => $setting,
            'initial_count' => auth()->user()->customer ? Application::whereIn('vacancy_id',Vacancy::where('customer_id',auth()->user()->customer->id)->pluck('id'))->count() : 0
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
                'email' => $user->email,
                'address' => $user->candidate->address,
                'skills' => $user->candidate->skills,
                'educational_qualifications' => $user->candidate->educational_qualifications
            ];
        }
        return view('profile', compact('data', 'profile', 'user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if ($request->user_type == 'candidate') {
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'address' => 'required|string',
                'skills' => 'required|string',
                'educational_qualifications' => 'required|string'
            ]);

            User::find($user->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
            }

            Candidate::where('id', $user->candidate->id)->update([
                'address' => $request->address,
                'skills' => $request->skills,
                'educational_qualifications' => $request->educational_qualifications
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'company_email' => 'required|email|unique:customers,company_email,' . $user->customer->id,
                'company_phone' => 'required|numeric',
                'company_address' => 'required',
                'designation' => 'required|string',
                'company_description' => 'required|string'
            ]);
            User::find($user->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            Customer::where('id', $user->customer->id)->update([
                'company_email' => $request->company_email,
                'company_phone' => $request->company_phone,
                'company_address' => $request->company_address,
                'designation' => $request->designation,
                'company_description' => $request->company_description
            ]);
        }
        return redirect()->route('profile')->with('success', 'Profile updated Successfully');
    }

    public function resetPassword(Request $request)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect()->back()->with("error", "Your current password does not match with the password.");
        }

        $this->validate($request, [
            'password' => 'required|string',
            'new_password' => 'required|string|different:password'
        ], [
            'new_password.different' => 'The new password must be different from old password.'
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('success', 'Password Changed successfully. Log in with New Password');
    }
}
