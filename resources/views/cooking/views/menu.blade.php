@extends('cooking.views.app')

@section('title',"Menu")
@section('styles')
    <link rel="stylesheet" href="{{ asset('restaurant/css/menu.css') }}">
@endsection
@section('content')
@include('cooking.views.menuCollection')
@endsection
@auth
@section('script-category')
<script src="{{asset('restaurant/js/menu-category.js')}}"></script>
@endsection
@endauth