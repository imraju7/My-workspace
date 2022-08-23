<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Homepage',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'vacancies' => Vacancy::where('is_published', true)->count(),
            'candidates' => Candidate::count(),
            'jobs' => Vacancy::orderBy('id', 'desc')->where('is_published', true)->limit(5)->get(),
            'setting' => $setting
        ];
        return view('home', compact('data'));
    }
}
