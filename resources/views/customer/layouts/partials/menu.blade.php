<div class="ui square-border no-margin menu">
        {{--<form class="ui small labeled input">--}}
                {{--<div class="ui label">Số lượng</div>--}}
                {{--<select class="ui selection dropdown" name="quantity">--}}
                        {{--<option value="5">5</option>--}}
                        {{--<option value="10" {{ (Request::get('quantity')=='10') ? 'selected' : '' }}>10</option>--}}
                        {{--<option value="20" {{ (Request::get('quantity')=='20') ? 'selected' : '' }}>20</option>--}}
                        {{--<option value="50" {{ (Request::get('quantity')=='50') ? 'selected' : '' }}>50</option>--}}
                {{--</select>--}}
                {{--<div class="ui label" style="border-bottom-left-radius: 0; border-top-left-radius: 0">--}}
                        {{--Khoảng thời gian--}}
                {{--</div>--}}
                {{--<select class="ui selection dropdown" name="time">--}}
                        {{--@for($i=1; $i<=12; $i++)--}}
                                {{--<option value="{{ $i }}" {{ (Request::get('time')==$i) ? 'selected' : '' }}>{{ $i }}</option>--}}
                        {{--@endfor--}}
                {{--</select>--}}
                {{--<select class="ui selection dropdown" name="time-type">--}}
                        {{--<option value="day" {{ (Request::get('time-type')=='day') ? 'selected' : '' }}>Ngày</option>--}}
                        {{--<option value="week" {{ (!Request::has('quantity') || (Request::get('time-type')=='week')) ? 'selected' : '' }}>--}}
                                {{--Tuần--}}
                        {{--</option>--}}
                        {{--<option value="month" {{ (Request::get('time-type')=='month') ? 'selected' : '' }}>Tháng</option>--}}
                        {{--<option value="year" {{ (Request::get('time-type')=='year') ? 'selected' : '' }}>Năm</option>--}}
                {{--</select>--}}
                {{--<button class="ui button" type="submit"--}}
                        {{--style="border-bottom-left-radius: 0; border-top-left-radius: 0">Xem</button>--}}
        {{--</form>--}}
    @php $trademarks = \App\Trademark::all() @endphp
    @foreach($trademarks as $trademark)
        <a class="item" href="#">
            {{ $trademark->name }}
        </a>
    @endforeach

    {{--<a class="item" href="{{ route('product.special', ['sale']) }}">--}}
        {{--<i class="percent icon"></i> Giảm giá--}}
    {{--</a>--}}
    {{--<a class="item" href="{{ route('product.special', ['new']) }}">--}}
        {{--<i class="certificate icon"></i> Mới--}}
    {{--</a>--}}
</div>