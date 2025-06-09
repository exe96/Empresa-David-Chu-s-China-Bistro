@php
$title='Items not found';
@endphp
@extends('cook.template.app.app')
@section('description', 'Sorry, we could not find the items you were looking for. Please try again later or contact us for assistance.')
@section('title',$title )
{{-- @section('styles')
    <link rel="stylesheet" href="{{ asset('restaurant/css/menuItems.css') }}">
@endsection --}}
@section('content')
@include('cook.items.itemsErrorContent')
@endsection


{{-- @auth
@section('script-category')
<script src="{{asset('restaurant/js/menu-items.js')}}"></script>
@endsection
@endauth --}}
