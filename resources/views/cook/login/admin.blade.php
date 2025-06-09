@extends('cook.template.app.app')
@section('styles')
<link rel="stylesheet" href="{{asset('restaurant/css/admin.css')}}">
@endsection

@section('title',"Inicio sesión")

@section('content')
@include('cook.login.admin-content')
@endsection
