@extends('admin.master')

@section('title', 'Sản phẩm')

@section('nav_title', 'Sản phẩm')

@section('content')
    <div class="field">
        <label>Giá</label>
        <input type="text" name="gia" required min="1000" max="100000000"
               pattern="[a-z]" placeholder="Chấp nhận khoảng trắng">
    </div>
@endsection