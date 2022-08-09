@extends('layouts.app')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="intro row text-center justify-content-center">
                        <h2 class="mb-4">Welcome to {{ $data['businessName'] }}</h2>
                        <p>
                            {!! $data['about_text'] !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
