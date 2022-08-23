<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Setting;

class CandidateController extends Controller
{
    public function search(Request $request)
    {
        $setting = Setting::first();
        $candidates = Candidate::query();
        if (request('skill') && request('address')) {
            $candidates->where('skills', 'Like', '%' . $request->skill . '%')
                ->where('address', 'Like', '%' . $request->address . '%');
        } elseif (request('skill')) {
            $candidates->where('skills', 'Like', '%' . $request->skill . '%');
        } else {
            $candidates->where('skills', 'Like', '%' . $request->skill . '%');
        }
        $data = [
            'pageTitle' => 'Available Jobs',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'candidates' => $candidates->where('is_recruited', false)->orderBy('id', 'desc')->paginate(5),
            'setting' => $setting
        ];
        return view('candidates', compact('data'));
    }
}
