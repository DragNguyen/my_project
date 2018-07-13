<div class="mini ui modal" id="modal-add-images">
    <div class="header modal-header">Thêm hình ảnh cho sản phẩm</div>
    <div class="scrolling content">
        <form class="ui form" method="post" enctype="multipart/form-data"
              action="{{ route('product_add_image', [$product->id]) }}" id="form-add-images">
            {{ csrf_field() }}
            <div class="field" style="margin-bottom: -20px">
                <ul id="product-image" style="margin-bottom: 0px; word-wrap: break-word">
                </ul>
                <label for="product-image-upload" class="ui fluid button" style="width: 100%; margin-top: 3px; margin-bottom: 20px">
                    Chọn ảnh
                </label>
                <input class="hidden" type="file" multiple
                       accept=".jpg, .png, .jpeg" id="product-image-upload" name="product-image-upload[]">
            </div>
        </form>
    </div>
    <div class="actions">
        <input type="submit" class="ui fluid blue button" value="OK" form="form-add-images">
    </div>
</div>