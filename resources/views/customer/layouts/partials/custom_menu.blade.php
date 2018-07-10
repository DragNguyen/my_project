<form id="form">
    <div class="ui labeled input" style="min-width: 240px">
        <div class="ui label">
            Thương hiệu
        </div>
        <select class="ui fluid search selection dropdown"
                name="trademark" onchange="formSubmit() " id="trademark">
            <option value="all">Tất cả</option>
            @foreach($trademarks as $trademark)
                <option value="{{ $trademark->id }}" {{ (Request::get('trademark')==$trademark->id)?'selected':'' }}>
                    {{ $trademark->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="ui labeled input" style="min-width: 330px">
        <div class="ui label">
            Giá
        </div>
        <select class="ui fluid selection dropdown custom" name="cost" id="cost"
                onchange="formSubmit()">
            <option value="all">Tất cả</option>
            <option value="5" {{ (Request::get('cost')=='5')?'selected':'' }}>Dưới 5 triệu</option>
            <option value="5-10" {{ (Request::get('cost')=='5-10')?'selected':'' }}>Từ 5 - 10 triệu</option>
            <option value="10-15" {{ (Request::get('cost')=='10-15')?'selected':'' }}>Từ 10 - 15 triệu</option>
            <option value="15-20" {{ (Request::get('cost')=='15-20')?'selected':'' }}>Từ 15 - 20 triệu</option>
            <option value="20" {{ (Request::get('cost')=='20')?'selected':'' }}>Trên 20 triệu</option>
        </select>
        <select class="ui fluid selection dropdown" onchange="formSubmit()"
                id="order-by" name="order-by">
            <option value="asc">Tăng dần</option>
            <option value="desc" {{ (Request::get('order-by')=='desc')?'selected':'' }}>Giảm dần</option>
        </select>
    </div>
</form>

<style>
    .ui.selection.dropdown {
        border-radius: 0 .285714rem .285714rem 0;
    }
    .ui.selection.dropdown.custom {
        border-radius: 0;
    }
</style>

@push('script')
    <script>
        function formSubmit() {
            let trademark = document.getElementById('trademark');
            let cost = document.getElementById('cost');
            let order_by = document.getElementById('order-by');
            if (trademark.options[trademark.selectedIndex].value === 'all') {
                trademark.setAttribute('disabled', 'disabled');
            }
            if (cost.options[cost.selectedIndex].value === 'all') {
                cost.setAttribute('disabled', 'disabled');
            }
            if (order_by.options[order_by.selectedIndex].value === 'asc') {
                order_by.setAttribute('disabled', 'disabled');
            }
            document.getElementById('form').submit();
        }
    </script>
@endpush