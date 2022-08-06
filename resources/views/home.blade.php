@extends('layouts.app')

@section('content')
    @include('partials.banner')
    @if (count($data['jobs']) != 0)
        @include('partials.hot-jobs')
    @endif
@endsection
