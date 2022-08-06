<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Register',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
        ];
        return view('auth.register', compact('data'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'role' => 'required|in:customer,candidate',
        ], [
            'password.regex' => 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character ( ! , ” , # , $ , %	, & , *).'
        ]);

        $role_id = Role::where('name', $request->role)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role_id->id,
            'password' => bcrypt($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user, $remember = true);

        return redirect()->route('verification.notice');

        if ($user->role->name == 'candidate') {
            return redirect()->route('homepage')->with('success', 'Enjoy the application crafted beautifully just for you 😉');
        }
        return redirect()->route('my-jobs')->with('success', 'Enjoy the application crafted beautifully just for you. Verify the KYC first though.');
    }
}
