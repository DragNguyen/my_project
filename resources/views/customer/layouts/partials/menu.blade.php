<div class="ui square-border no-margin menu">
    @foreach($menuItems as $item)
        <a class="item" href="{{ $item->link }}">
            <i class="{{ $item->icon }} icon"></i> {{ $item->name }}
        </a>
    @endforeach

    <a class="item" href="{{ route('product.special', ['sale']) }}">
        <i class="percent icon"></i> Giảm giá
    </a>
    <a class="item" href="{{ route('product.special', ['new']) }}">
        <i class="certificate icon"></i> Mới
    </a>
</div>