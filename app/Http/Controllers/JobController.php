<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
            'jobs' => Vacancy::paginate(5)
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
            'applied' => Application::where('vacancy_id',$job->id)->where('user_id',auth()->user()->id)->first() ? true : false
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

        return redirect()->route('jobs.detail', $id);
    }

    public function myjobs()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'My Jobs',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
            'jobs' => Vacancy::where('customer_id', auth()->user()->customer->id)->paginate(5)
        ];
        return view('my-jobs', compact('data'));
    }

    public function create()
    {
        $setting = Setting::first();
        $data = [
            'pageTitle' => 'Create a job',
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
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

        return redirect()->route('jobs');
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
            'logo' => $setting->getFirstMedia()->getUrl('logosize') ?? 'default.jpg',
            'favicon' => $setting->getFirstMedia()->getUrl('favicon') ?? 'favicon.jpg',
            'applicants' => Application::where('vacancy_id', $vacancy->id)->get()
        ];
        return view('job-applicants', compact('data'));
    }
}
