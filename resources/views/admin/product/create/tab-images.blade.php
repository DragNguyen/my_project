<div class="ui top attached tabular menu">
    <a class="item active" data-tab="first-first">Đại diện</a>
    <a class="item" data-tab="second-second">Chi tiết</a>
</div>

<div class="ui bottom attached tab segment active" style="margin-bottom: 0px" data-tab="first-first">
    <div class="field">
        <img class="ui fluid image" id="product-avatar-preview" src="">
        <label for="product-avatar-upload" class="ui button" style="width: 100%; margin-top: 3px; margin-bottom: 20px">
            Chọn ảnh
        </label>
        <input class="hidden" type="file" accept=".jpg, .png, .jpeg" id="product-avatar-upload" name="product-avatar-upload">
    </div>
</div>

<div class="ui bottom attached tab segment" data-tab="second-second">
    <div class="field">
        <ul id="product-image" style="margin-bottom: 0px; word-wrap: break-word">
        </ul>
        <label for="product-image-upload" class="ui fluid button" style="width: 100%; margin-top: 3px; margin-bottom: 20px">
            Chọn ảnh
        </label>
        <input class="hidden" type="file" multiple
               accept=".jpg, .png, .jpeg" id="product-image-upload" name="product-image-upload[]">
    </div>
</div>