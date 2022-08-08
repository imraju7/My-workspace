@extends('layouts.app')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"></span>
                            <h2 class="mb-4"> Applied Jobs</h2>
                        </div>
                    </div>
                    <div class="row">
                        @if (count($data['applications']) != 0)
                            @foreach ($data['applications'] as $application)
                                <div class="col-md-12 ftco-animate">
                                    <div class="job-post-item py-4 d-block d-lg-flex align-items-center">
                                        <div class="one-third mb-4 mb-md-0">
                                            <div class="job-post-item-header d-flex align-items-center">
                                                <h2 class="mr-3 text-black">{{ $application->vacancy->title }}
                                                </h2>
                                                {{-- <div class="badge-wrap">
                                                <span
                                                    class="bg-primary text-white badge py-2 px-3">{{ ucfirst($applicant->job_type) }}</span>
                                            </div> --}}
                                            </div>
                                            <div class="job-post-item-body d-block d-md-flex">
                                                <div class="mr-3"><span class="icon-building"></span>
                                                    {{ ucWords($application->vacancy->company->company_name) }}</div>
                                                <div class="mr-3"><span class="icon-my_location"></span>
                                                    <span>{{ $application->vacancy->company->company_address }}</span>
                                                </div>
                                                <div><span class="icon-mail_outline"></span>
                                                    <span>{{ $application->vacancy->company->company_email }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="one-forth ml-auto d-flex align-items-center">
                                            <div>
                                                <a href="{{ route('jobs.candidates.message', ['job_id' => $application->vacancy->id, 'applicant_id' => $application->id]) }}"
                                                    class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                    <span class="icon-envelope" title="Message"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end -->
                            @endforeach
                        @else
                            <div class="col-md-12 ftco-animate">
                                <p style="color: red;">No Applied jobs at the moment !</p>
                            </div><!-- end -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
