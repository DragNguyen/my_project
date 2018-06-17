<div class="mini ui modal" id="modal-change-avatar">
    <div class="header modal-header">Thay đổi ảnh đại diện</div>
        <div class="content">
            <form class="ui form" method="post" enctype="multipart/form-data" action="{{ route('update_avatar', [$admin->id]) }}">
                {{ csrf_field() }}
                <div class="field">
                    <img class="ui fluid image" id="avatar-preview" src="/{{ (empty($admin->avatar)?
                    'assets/img/avatar/default.jpg':$admin->avatar) }}">
                    <label for="avatar-upload" class="ui button right floated" style="width: 50%; margin-top: 3px; margin-bottom: 20px">
                        Chọn ảnh đại diện
                    </label>
                    <input class="hidden" type="file" accept=".jpg, .png, .jpeg" id="avatar-upload" name="avatar-upload">
                </div>
                <div class="field">
                    <button class="ui fluid blue button" type="submit">
                        <strong>OK</strong>
                    </button>
                </div>
            </form>
        </div>
</div>