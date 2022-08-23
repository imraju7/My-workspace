@extends('layouts.app')
@section('content')
    <div class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <br>
                    <h4>Applicant : {{ ucfirst($data['applicant']->user->name) }}
                        <a href="{{ route('jobs.applicants', $data['applicant']->vacancy->id) }}">
                            <span class="bg-warning text-white badge py-2 px-3">Go Back </span>
                        </a>
                    </h4>
                    <span class="bg-primary text-white badge py-2 px-3">{{ ucfirst($data['applicant']->vacancy->job_type) }}
                    </span>
                    @if ($data['applicant']->is_accepted)
                        <span class="bg-success text-white badge py-2 px-3">Accepted</span>
                    @endif
                    @if ($data['applicant']->is_rejected)
                        <span class="bg-danger text-white badge py-2 px-3">Rejected</span>
                    @endif
                    <br>
                    <br>
                    <div class="col-lg-8">
                        <form action="{{ route('jobs.applicants.application-action', $data['applicant']->id) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="message" cols="30" rows="4" class="form-control"
                                    placeholder=" Default : Accepted - You have been selected for the next phase of the job interview. Rejected - Your Job application have been rejected."></textarea>
                                @error('message')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            @if (!$data['applicant']->is_accepted && !$data['applicant']->is_rejected)
                                <div class="form-group">
                                    <input type="submit" name="action" value="Accept" class="btn btn-primary py-3 px-5">
                                    <input type="submit" name="action" value="Reject" class="btn btn-danger py-3 px-5">
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <br>
                    <h4 style="color:black;"> Educational Qualifications </h4>
                    <p style="color:black;">{{ ucwords($data['applicant']->user->candidate->educational_qualifications) }}
                    </p>
                    <h4 style="color:black;"> Skills </h4>
                    <p style="color:black;">{{ ucwords($data['applicant']->user->candidate->skills) }}</p>
                    <p style="color:black;" class="mb-0">Email Address</p>
                    <p style="color:black;" class="mb-0"><a href="mailto:{{ $data['applicant']->user->email }}"><span
                                class="__cf_email__">{{ $data['applicant']->user->email }}</span></a>
                    </p>
                    <a href="{{ route('jobs.applicants.download', $data['applicant']->id) }}"> <span
                            class="bg-success text-white badge py-2 px-3"><span class="icon-download"
                                title="Download Application"></span> Download Cv</span>

                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
