<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\CompanyType;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Vacancy;

class JobController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Available Jobs',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'jobs' => Vacancy::paginate(5),
            'setting' => $setting
        ];
        return view('jobs', compact('data'));
    }

    public function search(Request $request)
    {
        $setting = Setting::first();
        $jobs = Vacancy::query();
        if (request('job_type')) {
            $jobs->where('job_type', $request->job_type)
                ->where('title', 'Like', '%' . $request->title . '%');
        } else {
            $jobs->where('title', 'Like', '%' . $request->title . '%');
        }
        $data = [
            'pageTitle' => 'Available Jobs',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'jobs' => $jobs->orderBy('id', 'desc')->paginate(5),
            'setting' => $setting
        ];
        return view('jobs', compact('data'));
    }

    public function detail($id)
    {
        $job = Vacancy::findOrFail($id)->load('company');
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Job Detail',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
            'job' => $job,
            'setting' => $setting,
            'applied' => Application::where('vacancy_id', $job->id)->where('user_id', auth()->user()->id)->first() ? true : false
        ];

        return view('job-detail', compact('data'));
    }

    public function apply(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        $fileName = time() . '.' . $request->file->extension();

        Application::create([
            'user_id' => auth()->user()->id,
            'vacancy_id' => $id,
            'file' => $fileName
        ]);

        $request->file->move(public_path('uploads'), $fileName);

        return redirect()->route('jobs.detail', $id)->with('success', 'Applied to the job successfully. Watch out for Mails and Messages !');
    }

    public function myjobs()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'My Jobs',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'jobs' => Vacancy::where('customer_id', auth()->user()->customer->id)->paginate(5),
            'setting' => $setting
        ];
        return view('my-jobs', compact('data'));
    }

    public function create()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Create a job',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'company' => Customer::where('user_id', auth()->user()->id)->first()
        ];
        return view('post-job', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'job_type' => 'required|in:full-time,part-time,casual,contract',
            'description' => 'required'
        ]);

        Vacancy::create([
            'customer_id' => auth()->user()->customer->id,
            'title' => $request->title,
            'job_type' => $request->job_type,
            'is_vacant' => 1,
            'description' => $request->description
        ]);

        return redirect()->route('my-jobs')->with('success', 'New Job created successfully. Sit back while Applicants apply to the job.');
    }

    public function edit($id)
    {
        $job = Vacancy::findOrFail($id);
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Create a job',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'company' => Customer::where('user_id', auth()->user()->id)->first(),
            'job' => $job
        ];
        return view('edit-job', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'job_type' => 'required|in:full-time,part-time,casual,contract',
            'description' => 'required'
        ]);
        $job = Vacancy::findOrFail($id);
        $job->update([
            'title' => $request->title,
            'job_type' => $request->job_type,
            'description' => $request->description
        ]);
        return redirect()->route('my-jobs')->with('success', 'Job updated successfully.');
    }

    public function delete($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        Application::where('vacancy_id', $vacancy->id)->delete();
        $vacancy->delete();
        return redirect()->route('jobs')->with('success', 'Job post deleted successfully');
    }

    public function applicants($id)
    {
        $vacancy = Vacancy::findorFail($id);
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Applications',
            'logo' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('logosize') : 'default.jpg',
            'favicon' => optional($setting)->getFirstMedia() ? $setting->getFirstMedia()->getUrl('favicon') : 'favicon.jpg',
            'applicants' => Application::where('vacancy_id', $vacancy->id)->get(),
            'vacancy' => $vacancy
        ];
        return view('job-applicants', compact('data'));
    }

    public function download_cv($id)
    {
        $application = Application::findOrFail($id);
        return response()->download(public_path('uploads/' . $application->file));
    }

    public function hire($id)
    {
        $applicant = Application::findOrFail($id);
        $vacancy = Vacancy::find($applicant->vacancy_id);
        $vacancy->is_vacant = false;
        $vacancy->save();
        $candidate = Candidate::find($applicant->user->candidate->id);
        $candidate->is_recruited = true;
        $candidate->recruited_by = $vacancy->customer_id;
        $candidate->save();
        return redirect()->back()->with('success', 'Candidate Hired !');
    }
}
