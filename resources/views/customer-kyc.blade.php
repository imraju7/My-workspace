@extends('layouts.app')
@section('content')
    <div class="ftco-section  bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 mb-5">
                    <p class="font-weight-bold" style="font-size: 30px; color: blue;">KYC verification - Fill your information
                        to continue</p>
                    <form method="POST" action="{{ route('customer.kyc') }}" class="p-5 bg-white">
                        @csrf
                        {{-- <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-price-1">
                                    <input type="checkbox" id="option-price-1"> <span class="text-success">$500</span> For
                                    30 days
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-price-2">
                                    <input type="checkbox" id="option-price-2"> <span class="text-success">$300</span> /
                                    Monthly Recurring
                                </label>
                            </div>
                        </div> --}}

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="{{ old('company_name') }}" placeholder="eg. Facebook, Inc.">
                                @error('company_name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="company_type_id">Company Type</label>
                                <select name="company_type_id" class="form-control">
                                    <option value="">Select a Type</option>
                                    @foreach ($data['companyTypes'] as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_type_id')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <h3>Describe your company</h3>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea name="company_description"
                                    placeholder="Our company develops creative products and services that provides bundle of services like web design and development, custom applications as per business requirements, ERPs, CRMs, E-commerce solutions, business-to-business applications"
                                    class="form-control" id="" cols="30" rows="5">{{ old('company_description') }}</textarea>
                                @error('company_description')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="company_phone">Company Phone</label>
                                <input type="text" id="company_phone" name="company_phone" class="form-control"
                                    value="{{ old('company_phone') }}" placeholder="+601 .. ">
                                @error('company_phone')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="company_email">Company Email</label>
                                <input type="email" class="form-control" id="company_email" name="company_email"
                                    value="{{ old('company_email') }}" placeholder="johndoe@anon.com">
                                @error('company_email')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="company_address">Company Address</label>
                                <input type="text" class="form-control" id="company_address" name="company_address"
                                    value="{{ old('company_address') }}" placeholder="404-street,Not found">
                                @error('company_address')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="designation">Your position in the company</label>
                                <input type="text" id="designation" name="designation" value="{{old('designation')}}" class="form-control"
                                    placeholder="Human Resource Manager">
                                @error('designation')
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

    @include('partials.newsletter')
@endsection
