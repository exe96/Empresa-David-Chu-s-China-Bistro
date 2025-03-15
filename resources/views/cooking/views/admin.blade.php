@extends('cooking.views.app')
@section('styles')
<link rel="stylesheet" href="{{asset('restaurant/css/admin.css')}}">
@endsection

@section('title',"Inicio sesión")

@section('content')
@include('cooking.views.admin-content')
@endsection