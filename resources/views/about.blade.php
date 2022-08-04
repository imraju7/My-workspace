@extends('layouts.app')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="intro row text-center justify-content-center">
                        <div class="col-md-9">
                            <img class="img-fluid" src="{{ asset('frontend/images/undraw_work_time_lhoj.svg') }}"
                                alt="">
                        </div>
                        <h2 class="mb-4">Welcome to {{ $data['businessName'] }}</h2>
                        <p>
                            {{ $data['about_text'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
