@extends('admin.master')

@section('title', 'Nhà cung cấp')

@section('nav_title', 'Nhà cung cấp')

@section('content')

    <h2 class="ui dividing header">Nhà cung cấp<a class="anchor" id="introduction"></a></h2>

    @include('admin.nha-cung-cap.table')
@endsection