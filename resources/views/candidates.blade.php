@extends('layouts.app')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"></span>
                            <h2 class="mb-4">Available Candidates</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($data['candidates'] as $candidate)
                            <div class="col-md-12 ftco-animate">
                                <div class="job-post-item py-4 d-block d-lg-flex align-items-center">
                                    <div class="one-third mb-4 mb-md-0">
                                        <div class="job-post-item-header d-flex align-items-center">
                                            <h2 class="mr-3 text-black">{{ ucWords($candidate->user->name) }}
                                            </h2>
                                            <div class="badge-wrap">
                                            </div>
                                        </div>
                                        <div class="job-post-item-body d-block d-md-flex">
                                            <div><span class="icon-my_location"></span>
                                                <span>{{ ucWords($candidate->address) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="one-forth ml-auto d-flex align-items-center">
                                        <div>
                                            <a href="{{ route('jobs.detail', $candidate->id) }}"
                                                class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                <button type="button" class="btn btn-primary py-2">View</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $data['candidates']->links('partials.paginate') }}
                </div>
            </div>
        </div>
    </section>
@endsection
