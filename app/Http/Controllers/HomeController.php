<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Vacancy;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (Auth::check()) {
            $data = [
                'pageTitle' => 'Homepage',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'vacancies' => Vacancy::where('is_published', true)->count(),
                'candidates' => Candidate::count(),
                'jobs' => Vacancy::orderBy('id', 'desc')->where('is_published', true)->limit(5)->get(),
                'setting' => $setting,
                'initial_count' => auth()->user()->customer ? Application::whereIn('vacancy_id', Vacancy::where('customer_id', auth()->user()->customer->id)->pluck('id'))->count() : 0
            ];
        } else {
            $data = [
                'pageTitle' => 'Homepage',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'vacancies' => Vacancy::where('is_published', true)->count(),
                'candidates' => Candidate::count(),
                'jobs' => Vacancy::orderBy('id', 'desc')->where('is_published', true)->limit(5)->get(),
                'setting' => $setting,
                'initial_count' => 0
            ];
        }

        return view('home', compact('data'));
    }
}
