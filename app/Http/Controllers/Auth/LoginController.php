<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Login',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'email' => optional($setting)->email ?? '',
        ];
        return view('auth.login', compact('data'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_banned) {
                Auth::logout();
                return redirect()->route('login')->with('banned', 'You have been banned from using the application. Contact admin for further support or inquiry.');
            }
            return redirect()->intended()
                ->withSuccess('You have Successfully logged in');
        }
        return redirect("login")->with('loginError', 'Opps! You have entered invalid credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }
}
