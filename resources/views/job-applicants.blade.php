@extends('layouts.app')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"></span>
                            <h2 class="mb-4">Job Applications</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($data['applicants'] as $applicant)
                            <div class="col-md-12 ftco-animate">
                                <div class="job-post-item py-4 d-block d-lg-flex align-items-center">
                                    <div class="one-third mb-4 mb-md-0">
                                        <div class="job-post-item-header d-flex align-items-center">
                                            <h2 class="mr-3 text-black"><a
                                                    href="{{ route('jobs.applicants', $applicant->id) }}">{{ $applicant->title }}</a>
                                            </h2>
                                            <div class="badge-wrap">
                                                <span
                                                    class="bg-primary text-white badge py-2 px-3">{{ ucfirst($applicant->job_type) }}</span>
                                            </div>
                                        </div>
                                        <div class="job-post-item-body d-block d-md-flex">
                                            <div class="mr-3"><span class="icon-layers"></span> <a
                                                    href="#">{{ $applicant->company->company_name }}</a></div>
                                            <div><span class="icon-my_location"></span>
                                                <span>{{ $applicant->company->company_address }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="one-forth ml-auto d-flex align-items-center">
                                        <div>
                                            <a href="{{ route('jobs.applicants', $applicant->id) }}"
                                                class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                <span class="icon-compass" title="View Applications"></span>
                                            </a>
                                        </div>
                                        <form method="POST" action="{{ route('jobs.delete', $applicant->id) }}">
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                class="btn btn-primary py-2">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- end -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
