<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Register',
            'logo' => $setting->getFirstMedia()->getUrl('logosize'),
            'favicon' => $setting->getFirstMedia()->getUrl('favicon')
        ];
        return view('auth.register', compact('data'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:customer,candidate',
        ]);

        $role_id = Role::where('name', $request->role)->get('id');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role_id,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user, $remember = true);
        return redirect()->route('kyc');
    }
}
