@php
$title=$foodDetails['title'][0]->title;

@endphp
@extends('cook.template.app.app')
@section('description', 'you can find the complete details of the food item here. Enjoy our delicious offerings and learn more about our menu items.')

@section('title',$title )
@section('styles')
    <link rel="stylesheet" href="{{ asset('restaurant/css/menuItems.css') }}">
@endsection
@section('content')
@include('cook.items.menuItems')
@endsection


@auth
@section('script-category')
<script src="{{asset('restaurant/js/menu-items.js')}}"></script>
@endsection
@endauth
