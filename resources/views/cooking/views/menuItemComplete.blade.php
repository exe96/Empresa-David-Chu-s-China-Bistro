@php
$title=$foodDetails['titles'][0]->title;
@endphp
@extends('cooking.views.app')
@section('title',$title )
@section('styles')
    <link rel="stylesheet" href="{{ asset('restaurant/css/menuItems.css') }}">
@endsection
@section('content')
@include('cooking.views.menuItems')
@endsection


@auth
@section('script-category')
<script src="{{asset('restaurant/js/menu-items.js')}}"></script>
@endsection
@endauth