<div class="mini ui modal" id="modal-change-product-avatar">
    <div class="header modal-header">Thay đổi ảnh đại diện</div>
    <div class="content">
        <form class="ui form" method="post" id="form-change-product-avatar" style="margin-bottom: 0"
              enctype="multipart/form-data" action="{{ route('product_change_avatar', [$product->id]) }}">
            {{ csrf_field() }}
            <div class="field">
                <img class="ui fluid image" id="product-avatar-preview" src="/{{ $product->avatar }}">
                <label for="product-avatar-upload" class="ui button right floated"
                       style="width: 50%; margin-top: 3px; margin-bottom: 20px">
                    Chọn ảnh đại diện
                </label>
                <input class="hidden" type="file" accept=".jpg, .png, .jpeg" id="product-avatar-upload" name="product-avatar-upload">
            </div>
        </form>
    </div>
    <div class="actions">
        <button class="ui fluid blue button" form="form-change-product-avatar">OK</button>
    </div>
</div>

@push('script')
    <script>
        function readURLProduct(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#product-avatar-preview').attr('src', e.target.result);
                    $('#product-avatar-preview').hide();
                    $('#product-avatar-preview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#product-avatar-upload").change(function() {
            readURLProduct(this);
        });
    </script>
@endpush