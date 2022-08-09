@extends('layouts.app')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"></span>
                            {{-- search --}}
                            <div class="ftco-search">
                                <div class="row">
                                    <div class="col-md-12 nav-link-wrap">
                                        <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                                href="#v-pills-1" role="tab" aria-controls="v-pills-1"
                                                aria-selected="true">Find a Job</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 tab-wrap">

                                        <div class="tab-content p-4" id="v-pills-tabContent">

                                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                                aria-labelledby="v-pills-nextgen-tab">
                                                <form action="{{ route('jobs.search') }}" method="GET" class="search-job">
                                                    <div class="row no-gutters">
                                                        <div class="col-md mr-md-2">
                                                            <div class="form-group">
                                                                <div class="form-field">
                                                                    <div class="icon"><span class="icon-briefcase"></span>
                                                                    </div>
                                                                    <input type="text" name="title" id="title"
                                                                        class="form-control" placeholder="eg. Garphics">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md mr-md-2">
                                                            <div class="form-group">
                                                                <div class="form-field">
                                                                    <div class="select-wrap">
                                                                        <div class="icon"><span
                                                                                class="ion-ios-arrow-down"></span></div>
                                                                        <select name="job_type" id="job_type"
                                                                            class="form-control">
                                                                            <option value="">Type</option>
                                                                            <option value="full-time">Full Time</option>
                                                                            <option value="part-time">Part Time</option>
                                                                            <option value="casual">Casual</option>
                                                                            <option value="contract">Contract</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-group">
                                                                <div class="form-field">
                                                                    <button type="submit"
                                                                        class="form-control btn btn-secondary">Search</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                                aria-labelledby="v-pills-performance-tab">
                                                <form action="{{ route('jobs.search') }}" method="GET" class="search-job">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <div class="form-group">
                                                                <div class="form-field">
                                                                    <div class="icon"><span class="icon-user"></span>
                                                                    </div>
                                                                    <input type="text" name="title" id="title"
                                                                        class="form-control" placeholder="eg. Adam Scott">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-group">
                                                                <div class="form-field">
                                                                    <div class="select-wrap">
                                                                        <div class="icon"><span
                                                                                class="ion-ios-arrow-down"></span></div>
                                                                        <select name="job_type" id="job_type"
                                                                            class="form-control">
                                                                            <option value="">Type</option>
                                                                            <option value="full-time">Full Time</option>
                                                                            <option value="part-time">Part Time</option>
                                                                            <option value="casual">Casual</option>
                                                                            <option value="contract">Contract</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-group">
                                                                <div class="form-field">
                                                                    <button type="submit"
                                                                        class="form-control btn btn-secondary">Search</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- search --}}

                        </div>
                    </div>
                    <h3 class="mb-4">Some Jobs you may like:</h3>
                    <div class="row">
                        @foreach ($data['jobs'] as $job)
                            <div class="col-md-12 ftco-animate">
                                <div class="job-post-item py-4 d-block d-lg-flex align-items-center">
                                    <div class="one-third mb-4 mb-md-0">
                                        <div class="job-post-item-header d-flex align-items-center">
                                            <h2 class="mr-3 text-black"><a
                                                    href="{{ route('jobs.detail', $job->id) }}">{{ ucWords($job->title) }}</a>
                                            </h2>
                                            <div class="badge-wrap">
                                                @if ($job->job_type == 'part-time')
                                                    <span
                                                        class="bg-primary text-white badge py-2 px-3">{{ ucfirst($job->job_type) }}</span>
                                                @endif
                                                @if ($job->job_type == 'full-time')
                                                    <span
                                                        class="bg-warning text-white badge py-2 px-3">{{ ucfirst($job->job_type) }}</span>
                                                @endif
                                                @if ($job->job_type == 'casual')
                                                    <span
                                                        class="bg-info text-white badge py-2 px-3">{{ ucfirst($job->job_type) }}</span>
                                                @endif
                                                @if ($job->job_type == 'contract')
                                                    <span
                                                        class="bg-danger text-white badge py-2 px-3">{{ ucfirst($job->job_type) }}</span>
                                                @endif
                                            </div>
                                            @auth
                                                @if ($job->hasApplied)
                                                    <div class="badge-wrap">
                                                        <span class="bg-danger text-white badge pl-2 py-2 px-3">Applied</span>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="job-post-item-body d-block d-md-flex">
                                            <div class="mr-3"><span class="icon-layers"></span>
                                                {{ ucWords($job->company->company_name) }}</div>
                                            <div><span class="icon-my_location"></span>
                                                <span>{{ ucWords($job->company->company_address) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="one-forth ml-auto d-flex align-items-center">
                                        <div>
                                            <a href="{{ route('jobs.detail', $job->id) }}"
                                                class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                <span class="icon-eye" title="View"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end -->
                        @endforeach
                    </div>
                    {{ $data['jobs']->links('partials.paginate') }}
                </div>
            </div>
        </div>
    </section>
@endsection
