<div class="ui bottom attached tab segment
{{ Request::has('quantity')?'active':'' }}" data-tab="second">
    <div class="ui dividing header" style="margin-top: 5px;">
        <h5>Top {{ Request::get('quantity') }} sản phẩm mua nhiều trong vòng
            {{ Request::get('time') }}
            @if(Request::get('type') == 'day')
                ngày
            @elseif(Request::get('type') == 'week')
                tuần
            @elseif(Request::get('type') == 'month')
                tháng
            @else
                năm
            @endif
        </h5>
    </div>
    <form class="ui small labeled input">
        <div class="ui label">Số lượng</div>
        <select class="ui selection dropdown" name="quantity">
            <option value="5">5</option>
            <option value="10" {{ (Request::get('quantity')=='10') ? 'selected' : '' }}>10</option>
            <option value="20" {{ (Request::get('quantity')=='20') ? 'selected' : '' }}>20</option>
            <option value="50" {{ (Request::get('quantity')=='50') ? 'selected' : '' }}>50</option>
        </select>
        <div class="ui label" style="border-bottom-left-radius: 0; border-top-left-radius: 0">
            Khoảng thời gian
        </div>
        <select class="ui selection dropdown" name="time">
            @for($i=1; $i<=12; $i++)
                <option value="{{ $i }}" {{ (Request::get('time')==$i) ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <select class="ui selection dropdown" name="type">
            <option value="day" {{ (Request::get('type')=='day') ? 'selected' : '' }}>Ngày</option>
            <option value="week" {{ (!Request::has('quantity') || (Request::get('type')=='week')) ? 'selected' : '' }}>
                Tuần
            </option>
            <option value="month" {{ (Request::get('type')=='month') ? 'selected' : '' }}>Tháng</option>
            <option value="year" {{ (Request::get('type')=='year') ? 'selected' : '' }}>Năm</option>
        </select>
        <button class="ui button" type="submit"
                style="border-bottom-left-radius: 0; border-top-left-radius: 0">Xem</button>
    </form>

    <table class="ui table celled striped compact">
        <thead>
        <tr>
            <th class="collapsing">STT</th>
            <th>Tên sản phẩm</th>
            <th class="collapsing">Lượt mua</th>
        </tr>
        </thead>
        <tbody>

        @foreach($product_hots as $stt => $product_hot)
            @if(Request::has('quantity'))
                @if($stt == Request::get('quantity'))
                    @break
                @endif
            @else
                @if($stt == 5)
                    @break
                @endif
            @endif
            @php $product = \App\Product::find($product_hot['id']); @endphp
            <tr>
                <td class="center aligned">{{ $stt + 1 }}</td>
                <td>
                    <img src="/{{ $product->avatar }}" class="ui mini image spaced">
                    <a href="{{ route('product.show', [$product->id]) }}">
                        {{ $product->name }}
                    </a>
                </td>
                <td class="center aligned"> {{ $product_hot['buys'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="ui column centered grid">
        {{ $product_hots->links() }}
    </div>
</div>

<style>
    .ui.labeled .ui.selection.dropdown {
        min-width: 100px;
    }
    .ui.labeled .ui.selection.dropdown {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }
</style>