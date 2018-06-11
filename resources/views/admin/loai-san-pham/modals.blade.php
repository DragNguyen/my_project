<div class="mini ui modal" id="modal-them-loai">
    <div class="header" style="font-size: 20px;">Thêm loại sản phẩm</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('loai-san-pham.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên loại sản phẩm</label>
                <input type="text" name="ten-loai" required maxlength="100" value="bla bla">
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>

        </form>
    </div>
</div>

@foreach($loai_san_phams as $loai_san_pham)
    <div class="mini ui modal" id="modal-sua-loai-{{ $loai_san_pham->id }}">
        <div class="header" style="font-size: 20px;">Sửa loại sản phẩm</div>
        <div class="content">
            <form class="ui form" action="{{ route('loai-san-pham.update', [$loai_san_pham->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên loại sản phẩm</label>
                    <input type="text" name="ten-loai" required maxlength="100" value="{{ $loai_san_pham->ten_loai }}">
                </div>
                <div class="field">
                    <button class="ui fluid blue button" type="submit">
                        <strong>OK</strong>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach