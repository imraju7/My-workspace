<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateSearchMail;

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

    public function mail_candidate(Request $request, $candidate_id)
    {
        if ($request->filled('message')) {
            $message = $request->message;
            $candidate = Candidate::findOrFail($candidate_id);
            $mail = $candidate->user->email;
            $company_name = auth()->user()->customer->company_name;
            $candidate_name = $candidate->user->name;
            Mail::to($mail)->send(new CandidateSearchMail($candidate_name, $message, $company_name));
            return redirect()->back()->with('success', 'Mail sent to candidate successfully');
        }
        return redirect()->back()->with('warning', 'Mail is empty ! ');
    }
}
