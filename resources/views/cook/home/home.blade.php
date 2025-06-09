@extends('cook.template.app.app')
@section('styles')
<link rel="preload" as="image" href="{{ asset('images/restaurant/jumbotron_992.jpg') }}">
@endsection
@section('title',"David Chu's China Bistro")

@section('content')
@include('cook.home.start')
@endsection
