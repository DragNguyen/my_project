@extends('admin.master')

@section('title', 'Thương hiệu')

@section('nav_title', 'Thương hiệu')

@section('content')
    <div class="ui fluid search selection dropdown">
        <input type="hidden" name="country">
        <i class="dropdown icon"></i>
        <div class="default text">Select Country</div>
        <div class="menu">
            <div class="item" data-value="af"><span class="ui center aligned label">fasdf</span>Afghanistan</div>
            <div class="item" data-value="ax"><span class="ui center aligned label">fasfwefwdf</span>Aland Islands</div>
            <div class="item" data-value="al"><span class="ui center aligned label">sdf</span>Albania</div>
            <div class="item" data-value="dz"><i class="dz flag"></i>Algeria</div>
            <div class="item" data-value="as"><i class="as flag"></i>American Samoa</div>
            <div class="item" data-value="ad"><i class="ad flag"></i>Andorra</div>
            <div class="item" data-value="ao"><i class="ao flag"></i>Angola</div>
        </div>
    </div>
@endsection