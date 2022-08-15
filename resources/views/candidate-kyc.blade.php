@extends('layouts.app')
@section('content')
    <div class="ftco-section  bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 mb-5">
                    <p class="font-weight-bold" style="font-size: 30px; color: blue;">KYC verification - Fill your information
                        to continue</p>
                    <form method="POST" action="{{ route('candidate.kyc') }}" class="p-5 bg-white">
                        @csrf
                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="address">Where do you live? <span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address') }}" placeholder="404-street,Not found">
                                @error('address')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <h3>Write your skills separated by comma here <span style="color: red;">*</span></h3>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea name="skills" placeholder="php,laravel,node-js,c#,javascript,css,html" class="form-control" id=""
                                    cols="30" rows="5">{{ old('skills') }}</textarea>
                                @error('skills')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <h3>Write the degrees you have here i.e Academic Qualifications <span
                                        style="color: red;">*</span></h3>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea name="educational_qualifications" placeholder="BBA,B-TECH,MCA,CSIT,HACKING,NETWORKING" class="form-control"
                                    id="" cols="30" rows="5">{{ old('educational_qualifications') }}</textarea>
                                @error('educational_qualifications')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Submit" class="btn btn-primary  py-2 px-5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('partials.newsletter') --}}
@endsection
