@extends('layouts.template')
@section('title')
Dashboard
@endsection
@section('css')
<style>
.mini-stat h4{
font-size: 10px !important;
}
.property{
  width: fit-content;
}
</style>
@endsection
@section('content')
@include('dashboard')
@endsection

