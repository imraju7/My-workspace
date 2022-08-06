@extends('layouts.app')
@section('content')
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-4">
                    <h2 class="h3">Contact Information</h2>
                </div>
                <div class="w-100"></div>
                <div class="col-md-4">
                    <p><span>Address:</span> {{ $data['setting']->address ?? 'Moon' }}</p>
                </div>
                <div class="col-md-4">
                    <p><span>Phone:</span> <a
                            href="tel:{{ $data['setting']->phone ?? 'Moon' }}">{{ $data['setting']->phone ?? 'Moon' }}</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <p><span>Email:</span> <a
                            href="mailto:{{ $data['setting']->email ?? 'Moon' }}">{{ $data['setting']->email ?? 'Moon' }}</a>
                    </p>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <form action="{{ route('contact') }}" method="POST" class="bg-white p-5 contact-form">
                        @csrf
                        <span style="color: red;">Every fields below should be filled.</span>
                        <div class="form-group">
                            <input type="text" required name="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Your Name">
                            @error('name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" required name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="Your Email">
                            @error('email')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" required name="subject" value="{{ old('subject') }}" class="form-control"
                                placeholder="Subject">
                            @error('subject')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="message" required cols="30" rows="7" class="form-control"> {{ old('message') }} </textarea>
                            @error('message')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>

                </div>

                <div class="col-md-6 d-flex">
                    <div id="google" class="bg-white">
                        <iframe src="{{ $data['setting']->location ?? 'Moon' }}" width="600" height="450"
                            frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- newsletter --}}
@endsection
