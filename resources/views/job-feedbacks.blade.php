@extends('layouts.app')

@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading"></span>
                            <h2 class="mb-4">{{ ucfirst($data['vacancy']->title) }} Feedbacks</h2>
                        </div>
                    </div>
                    <div class="row">
                        @if (count($data['feedbacks']) != 0)
                            @foreach ($data['feedbacks'] as $feedback)
                                <div class="col-md-12 ftco-animate">
                                    <div class="job-post-item py-4 d-block d-lg-flex align-items-center">
                                        <div class="one-third mb-4 mb-md-0">
                                            <div class="job-post-item-header d-flex align-items-center">
                                                <h2 class="mr-3 text-black">sdas</h2>
                                            </div>
                                            <div class="job-post-item-body d-block d-md-flex">
                                                <div class="mr-3"><span class="icon-person"></span>
                                                    {{ ucWords($feedback->user->name) }}</div>
                                                <div class="mr-3"><span class="icon-my_location"></span>
                                                    <span>{{ $feedback->user->candidate->address }}</span>
                                                </div>
                                                <div><span class="icon-mail_outline"></span>
                                                    <span>{{ $feedback->user->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            {{ $feedback->message }}
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
