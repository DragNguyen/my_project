<div class="mini ui modal" id="modal-them-ncc">
    <div class="header" style="font-size: 20px;">Thêm nhà cung cấp</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('nha-cung-cap.store') }}">
            {{ csrf_field() }}

            <div class="field">
                <label>Tên nhà cung cấp</label>
                <input type="text" name="ten-ncc" required maxlength="100" value="bla bla">
            </div>
            <div class="field">
                <label>Số điện thoại</label>
                <input type="text" name="so-dien-thoai" required maxlength="20" value="01639883047">
            </div>
            <div class="field">
                <label>Địa chỉ</label>
                <input type="text" name="dia-chi" required maxlength="100" value="bla bla">
            </div>
            <div class="field">
                <label>Website</label>
                <input type="text" name="website" required maxlength="20" value="bla bla">
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>

        </form>
    </div>
</div>

@foreach($nha_cung_caps as $nha_cung_cap)
    <div class="mini ui modal" id="modal-sua-ncc-{{ $nha_cung_cap->id }}">
        <div class="header" style="font-size: 20px;">Sửa nhà cung cấp</div>
        <div class="content">
            <form class="ui form" action="{{ route('nha-cung-cap.update', [$nha_cung_cap->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="field">
                    <label>Tên nhà cung cấp</label>
                    <input type="text" name="ten-ncc" required maxlength="100" value="{{ $nha_cung_cap->ten_ncc }}">
                </div>
                <div class="field">
                    <label>Số điện thoại</label>
                    <input type="text" name="so-dien-thoai" required maxlength="20" value="{{ $nha_cung_cap->so_dien_thoai }}">
                </div>
                <div class="field">
                    <label>Địa chỉ</label>
                    <input type="text" name="dia-chi" required maxlength="100" value="{{ $nha_cung_cap->dia_chi }}">
                </div>
                <div class="field">
                    <label>Website</label>
                    <input type="text" name="website" required maxlength="20" value="{{ $nha_cung_cap->website }}">
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