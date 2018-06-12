<div class="mini ui modal" id="modal-them-sp">
    <div class="header" style="font-size: 20px;">Thêm sản phẩm</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('san-pham.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên sản phẩm</label>
                <input type="text" name="ten-san-pham" required maxlength="100" value="Obi worldphone SF1">
            </div>
            <div class="field">
                <label>Giá</label>
                <input type="text" name="gia" required min="1000" max="100000000"
                       pattern="[0-9\s]+" placeholder="Chấp nhận khoảng trắng">
            </div>
            <div class="field">
                <label>Loại sản phẩm</label>
                <select class="ui search selection dropdown" name="ten-loai">
                    <option value="">Loại sản phẩm</option>
                    @foreach(\App\LoaiSanPham::all() as $loai_san_pham)
                        <option value="{{ $loai_san_pham->id }}">{{ $loai_san_pham->ten_loai }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Thương hiệu</label>
                <select class="ui search selection dropdown" name="ten-thuong-hieu">
                    <option value="">Thương hiệu</option>
                    @foreach(\App\ThuongHieu::all() as $thuong_hieu)
                        <option value="{{ $thuong_hieu->id }}">{{ $thuong_hieu->ten_thuong_hieu }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>
        </form>
    </div>
</div>