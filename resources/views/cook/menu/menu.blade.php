@extends('cook.template.app.app')
@section('description', 'Discover our exquisite menu featuring a variety of dishes crafted with the finest ingredients. Enjoy a culinary journey at our restaurant.')
@section('title',"Menu")
@section('styles')
    <link rel="stylesheet" href="{{ asset('restaurant/css/menu.css') }}">
@endsection
@section('content')
@include('cook.menu.menuCollection')
@endsection
@auth
@section('script-category')
<script src="{{asset('restaurant/js/menu-category.js')}}"></script>
@endsection
@endauth
