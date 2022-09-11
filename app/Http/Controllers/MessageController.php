<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Vacancy;

class MessageController extends Controller
{
    public function customer_messages($job_id, $applicant_id)
    {
        if (in_array($job_id, auth()->user()->customer->vacancy->pluck(['id'])->toArray())) {
            $job = Vacancy::findOrFail($job_id);
            if (in_array($applicant_id, Application::where('vacancy_id', $job->id)->get()->pluck(['id'])->toArray())) {
                $application = Application::with(['vacancy', 'user'])->findOrFail($applicant_id);
                $conversation = Conversation::with('message')->where('initiated_by', $job->company->user->id)
                    ->where('initiated_towards', $application->user->id)->first();
                $setting = Setting::first();
                $data = [
                    'pageTitle' => 'Message',
                    'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                    'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                    'setting' => $setting,
                    'application' => $application,
                    'conversation' => $conversation,
                    'job' => $job,
                    'initial_count' => auth()->user()->customer ? Application::whereIn('vacancy_id',Vacancy::where('customer_id',auth()->user()->customer->id)->pluck('id'))->count() : 0
                ];
                return view('customer-messages', compact('data'));
            }
        }
        abort(403);
    }

    public function store_message_from_customer(Request $request, $job_id, $applicant_id)
    {
        $job = Vacancy::findOrFail($job_id);
        $application = Application::findOrFail($applicant_id);
        $this->validate($request, [
            'message' => 'required|string|max:254'
        ]);
        // see if the conversation already exists
        $conversation = Conversation::firstOrCreate([
            'topic' => 'Conversation with Applicants',
            'initiated_by' => $job->company->user->id,
            'initiated_towards' => $application->user->id
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender' => $conversation->initiated_by,
            'receiver' => $conversation->initiated_towards,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function candidate_messages($job_id, $applicant_id)
    {
        // dd(auth()->user()->application->pluck(['id'])->toArray());
        if (in_array($applicant_id, auth()->user()->application->pluck(['id'])->toArray())) {
            $job = Vacancy::findOrFail($job_id);
            $application = Application::with(['vacancy', 'user'])->findOrFail($applicant_id);
            $conversation = Conversation::with('message')->where('initiated_by', $job->company->user->id)
                ->where('initiated_towards', $application->user->id)->first();
            $setting = Setting::first();
            $data = [
                'pageTitle' => 'Message',
                'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
                'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
                'setting' => $setting,
                'application' => $application,
                'conversation' => $conversation,
                'job' => $job,
                'initial_count' => auth()->user()->customer ? Application::whereIn('vacancy_id', Vacancy::where('customer_id', auth()->user()->customer->id)->pluck('id'))->count() : 0
            ];
            return view('candidate-messages', compact('data'));
        }
        abort(403);
    }

    public function store_message_from_candidate(Request $request, $job_id, $applicant_id)
    {
        $job = Vacancy::findOrFail($job_id);
        $application = Application::findOrFail($applicant_id);
        $this->validate($request, [
            'message' => 'required|string|max:254'
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender' => $conversation->initiated_towards,
            'receiver' => $conversation->initiated_by,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
