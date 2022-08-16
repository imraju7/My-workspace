@extends('layouts.app')

@section('content')
    @guest
        @include('partials.banner')
    @endguest

    @candidate
    @include('partials.banner')
    @endcandidate

    @customer
        @include('partials.candidate-search')
    @endcustomer

    @if (count($data['jobs']) != 0)
        @include('partials.hot-jobs')
    @endif
@endsection
