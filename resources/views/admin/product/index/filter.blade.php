<a class="ui green button" id="product-filter">
    <i class="fitted filter icon"></i></a>
<div class="ui flowing popup bottom left transition hidden" style="width: 200px">
    {{--<form method="get" class="ui small form">--}}

    <div class="field">
        <label>Thương hiệu</label>
        <select class="ui fluid selection dropdown" name="trademark-id">
            <option value="all">Tất cả</option>
            @foreach($trademarks as $trademark)
                <option value="{{ $trademark->id }}">{{ $trademark->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="field" style="margin-top: 10px">
        <label>Loại sản phẩm</label>
        <select class="ui fluid selection dropdown" name="product-type-id"></select>
    </div>

    <div class="field" style="margin-top: 15px">
        <button class="ui green fluid button" form="" type="submit">Lọc</button>
    </div>
    {{--</form>--}}
</div>

<script type="text/javascript">
    var url = "{{ url('/get_product_type') }}";
    $("select[name='trademark-id']").change(function(){
        var trademark_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                trademark_id: trademark_id,
                _token: token
            },
            success: function(data) {
                $("select[name='product-type-id']").html('');
                $.each(data, function(key, value){
                    $("select[name='product-type-id']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    });
</script>