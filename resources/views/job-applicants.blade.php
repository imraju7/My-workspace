@extends('layouts.app')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"></span>
                            <h2 class="mb-4">{{ ucfirst($data['vacancy']->title) }} Applications</h2>
                        </div>
                    </div>
                    <div class="row">
                        @if (count($data['applicants']) != 0)
                            @foreach ($data['applicants'] as $applicant)
                                <div class="col-md-12 ftco-animate">
                                    <div class="job-post-item py-4 d-block d-lg-flex align-items-center">
                                        <div class="one-third mb-4 mb-md-0">
                                            <div class="job-post-item-header d-flex align-items-center">
                                                <h2 class="mr-3 text-black">{{ ucwords($applicant->user->name) }}
                                                </h2>
                                                @if ($applicant->is_accepted)
                                                    <div class="badge-wrap">
                                                        <span class="bg-success text-white badge py-2 px-3">Accepted</span>
                                                    </div>
                                                @endif
                                                @if ($applicant->is_rejected)
                                                <div class="badge-wrap">
                                                    <span class="bg-danger text-white badge py-2 px-3">Rejected</span>
                                                </div>
                                            @endif
                                            </div>
                                            <div class="job-post-item-body d-block d-md-flex">
                                                <div class="mr-3"><span class="icon-my_location"></span>
                                                    <span>{{ $applicant->user->candidate->address }}</span>
                                                </div>
                                                <div><span class="icon-mail_outline"></span>
                                                    <span>{{ $applicant->user->email }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="one-forth ml-auto d-flex align-items-center">
                                            <div>
                                                <a href="{{ route('jobs.applicants.message', ['job_id' => $data['vacancy']->id, 'applicant_id' => $applicant->id]) }}"
                                                    class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                    <span class="icon-envelope" title="Message"></span>
                                                </a>
                                            </div>
                                            @if (!$applicant->is_accepted && !$applicant->is_rejected)
                                                <form method="POST"
                                                    action="{{ route('jobs.applicants.accept', $applicant->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to Accept this candidate?');"
                                                        class=" mr-2 btn btn-primary py-2">Accept</button>
                                                </form>
                                            @endif
                                            @if (!$applicant->is_rejected && !$applicant->is_accepted)
                                                <form method="POST"
                                                    action="{{ route('jobs.applicants.reject', $applicant->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to Reject this candidate?');"
                                                        class="btn btn-danger py-2">Reject</button>
                                                </form>
                                            @endif
                                            <div class="ml-2">
                                                <a href="{{ route('jobs.applicants.download', $applicant->id) }}"
                                                    class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                    <span class="icon-download" title="View Applications"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end -->
                            @endforeach
                        @else
                            <div class="col-md-12 ftco-animate">
                                <p style="color: red;">No Applicants at the moment !</p>
                            </div><!-- end -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
