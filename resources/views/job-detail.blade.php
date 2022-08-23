@extends('layouts.app')
@section('content')
    <div class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <br>
                    <h1>{{ ucfirst($data['job']->title) }}</h1>
                    <h4>By : {{ ucfirst($data['job']->company->company_name) }}
                        ({{ ucfirst($data['job']->company->type->name) }})</h4>
                    <span class="bg-success text-white badge py-2 px-3">{{ ucfirst($data['job']->job_type) }}</span>
                    @if ($data['applied'])
                        @if ($data['accepted'])
                            <p><button disabled href="#" class="btn btn-success mt-4 py-2 px-4">Accepted</button></p>
                        @elseif ($data['rejected'])
                            <p><button disabled href="#" class="btn btn-danger mt-4 py-2 px-4">Rejected</button></p>
                        @else
                            <p><button disabled href="#" class="btn btn-warning mt-4 py-2 px-4">Applied</button></p>
                        @endif
                    @endif
                    <br>
                    <h2></h2>
                    <p>{!! $data['job']->description !!}</p>
                    <div class="col-lg-8">
                        <form action="{{ route('jobs.feedback.create', $data['job']->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="message" required cols="30" rows="5" class="form-control"> {{ old('message') }} </textarea>
                                @error('message')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Send Feedback" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    @if ($data['applied'])
                        <br>
                    @else
                        <form action="{{ route('jobs.apply', $data['job']->id) }}" method="POST"
                            enctype="multipart/form-data" class="p-5 bg-white">
                            @csrf
                            <label class="font-weight-bold" for="title">Upload Your CV here </label>
                            <input type="file" accept="application/pdf" id="file" name="file"
                                class="form-control">
                            @error('file')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <br>
                            <p><button href="{{ route('jobs.apply', $data['job']->id) }}"
                                    class="btn btn-secondary py-2 px-4">Apply</button></p>
                        </form>
                    @endif
                    <h3 class="h5 text-black mb-3">Information</h3>
                    <p class="mb-0 font-weight-bold">Job Location</p>
                    <p class="mb-4">{{ $data['job']->address }}</p>

                    <p class="mb-0 font-weight-bold">Phone</p>
                    <p class="mb-4"><a href="#">{{ $data['job']->company->company_phone }}</a></p>

                    <p class="mb-0 font-weight-bold">Email Address</p>
                    <p class="mb-0"><a href="#"><span class="__cf_email__"
                                data-cfemail="671e081215020a060e0b2703080a060e094904080a">{{ $data['job']->company->company_email }}</span></a>
                    </p>

                    {{-- </div> --}}

                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Company Description</h3>
                        <p>{{ $data['job']->company->company_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
