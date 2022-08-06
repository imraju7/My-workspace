<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->role->name == 'customer') {
                return redirect()->route('my-jobs');
            }
        }
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Homepage',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'vacancies' => Vacancy::count(),
            'jobs' => Vacancy::orderBy('id','desc')->limit(5)->get(),
            'setting' => $setting
        ];
        return view('home', compact('data'));
    }
}
