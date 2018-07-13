<div class="ui green scrolling floating icon dropdown button" id="key-filter">
    <input type="hidden" name="key-filter">
    <i class="filter icon"></i>
    <div class="menu">
        <div class="item" data-value="0">Chưa duyệt</div>
        <div class="item" data-value="1">Đang vận chuyển</div>
        <div class="item" data-value="2">Đã giao hàng</div>
    </div>
</div>

@if(Request::get('key-filter') != '')
    <div class="ui small label">
        @if($key_filter == 0)
            Chưa duyệt
        @elseif($key_filter == 1)
            Đang vận chuyển
        @else
            Đã giao hàng
        @endif
            <a href="{{ route('order.index') }}"><i class="delete fitted icon"></i></a>
    </div>
@endif