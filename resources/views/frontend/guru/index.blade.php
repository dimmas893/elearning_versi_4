@extends('layouts.template_guru')
@section('content')
    <h2>selamat datang {{Auth::guard('guru')->user()->name}}</h2>
@endsection