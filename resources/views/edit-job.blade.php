@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endpush

@section('content')
    <div class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <h1>Edit a Job</h1>
                    <form action="{{ route('jobs.edit', $data['job']->id) }}" method="POST" class="p-5 bg-white">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-12">
                                <a href="{{ route('my-jobs') }}"> <button type="button"
                                        class="btn btn-danger  py-2 px-5">Go Back </button> </a>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="title">Job Title</label>
                                <input type="text" id="title" name="title" value="{{ $data['job']->title }}"
                                    class="form-control" placeholder="eg. Professional UI/UX Designer">
                                @error('title')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="title">Job Location</label>
                                <input type="text" id="address" name="address" value="{{ $data['job']->address }}"
                                    class="form-control" placeholder="eg.sydney">
                                @error('address')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <h3>Job Type</h3>
                            </div>
                            @error('job_type')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-1">
                                    <input type="radio" @if ($data['job']->job_type == 'full-time') checked="checked" @endif
                                        id="option-job-type-1" value="full-time" name="job_type"> Full
                                    Time
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-2">
                                    <input type="radio" @if ($data['job']->job_type == 'part-time') checked="checked" @endif
                                        id="option-job-type-2" value="part-time" name="job_type"> Part
                                    Time
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-3">
                                    <input type="radio" @if ($data['job']->job_type == 'casual') checked="checked" @endif
                                        id="option-job-type-3" value="casual" name="job_type"> Casual
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-4">
                                    <input type="radio" @if ($data['job']->job_type == 'contract') checked="checked" @endif
                                        id="option-job-type-4" value="contract" name="job_type"> Contract
                                </label>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <h3>Describe the job requirements</h3>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea name="description" placeholder="" class="form-control description" id="" cols="30"
                                    rows="5">{{ $data['job']->description }}</textarea>
                                @error('description')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="is_published">
                                    <input type="checkbox" id="is_published" name="is_published"
                                        @if ($data['job']->is_published) @checked(true) @endif> Published
                                </label>
                                @error('is_published')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Update" class="btn btn-primary  py-2 px-5">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Company Contact Info</h3>
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4">{{ $data['company']->company_address }}</p>

                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="#">{{ $data['company']->company_phone }}</a></p>

                        <p class="mb-0 font-weight-bold">Email Address</p>
                        <p class="mb-0"><a href="#"><span class="__cf_email__"
                                    data-cfemail="671e081215020a060e0b2703080a060e094904080a">{{ $data['company']->company_email }}</span></a>
                        </p>

                    </div>

                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Company Description</h3>
                        <p>{{ $data['company']->company_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                popover: {
                    image: [

                    ]
                }
            });
        });
    </script>
@endpush
