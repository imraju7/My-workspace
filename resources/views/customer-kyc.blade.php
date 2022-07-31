@extends('layouts.app')
@section('content')
    <div class="ftco-section  bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 mb-5">
                    <p class="font-weight-bold" style="font-size: 30px; color: blue;">KYC verification - Fill your information
                        to continue</p>
                    <form action="#" class="p-5 bg-white">
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
                                <label class="font-weight-bold" for="fullname">Company Name</label>
                                <input type="text" id="fullname" class="form-control" placeholder="eg. Facebook, Inc.">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Company Type</label>
                                <select name="company_type_id" class="form-control">
                                    @foreach ($data['companyTypes'] as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <h3>Describe your company</h3>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea name=""
                                    placeholder="Our company develops creative products and services that provides bundle of services like web design and development, custom applications as per business requirements, ERPs, CRMs, E-commerce solutions, business-to-business applications"
                                    class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Company Phone</label>
                                <input type="text" id="fullname" class="form-control" placeholder="+601 .. ">
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Company Email</label>
                                <input type="email" id="fullname" class="form-control" placeholder="johndoe@anon.com">
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Company Address</label>
                                <input type="text" id="fullname" class="form-control"
                                    placeholder="404-street,Not found">
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="fullname">Your position in the company</label>
                                <input type="text" id="fullname" class="form-control"
                                    placeholder="Human Resource Manager">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Post" class="btn btn-primary  py-2 px-5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.newsletter')
@endsection
