@extends('cook.template.app.app')
@section('description', 'Sorry, we could not find the menu you were looking for. Please try again later or contact us for assistance.')
@section('title',"Erro menu not found")

@section('content')
@include('cook.menu.menuErrorContent')
@endsection

