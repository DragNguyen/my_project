@include('admin.product.show.modal-add-images')
{{--@include('admin.layouts.components.confirm')--}}

<h3 class="ui dividing header" style="margin-top: 5px">
    Ảnh sản phẩm
    <button class="ui small red label" type="submit" form="form-delete-image" onclick="return confirm('Xác nhận xóa?')">
        <i class="fitted remove icon"></i>
    </button>
    <a class="ui small blue label" onclick="$('#modal-add-images').modal('show')">
        <i class="fitted add icon"></i>
    </a>
</h3>

<form id="form-delete-image" method="post" action="{{ route('product_delete_image') }}">
    <div class="ui three column grid">
            {{ csrf_field() }}
            @foreach($images as $image)
                <div class="column middle aligned">
                        <input type="checkbox" id="table_records" class="flat"
                               name="image-ids[]" value="{{ $image->id }}">
                        <div class="ui medium image">
                            <img src="/{{ $image->link }}">
                        </div>
                </div>
            @endforeach
    </div>
</form>

{{--@push('script')--}}
    {{--<script>--}}
        {{--$('.modal-confirm')--}}
            {{--.modal({--}}
                {{--closable  : false,--}}
                {{--onDeny    : function(){--}}
                    {{--window.alert('Wait not yet!');--}}
                    {{--return false;--}}
                {{--},--}}
                {{--onApprove : function() {--}}
                    {{--window.alert('Approved!');--}}
                {{--}--}}
            {{--})--}}
            {{--.modal('show')--}}
        {{--;--}}
    {{--</script>--}}
{{--@endpush--}}