<div class="mini ui modal" id="modal-create-product">
    <div class="header modal-header">Thêm sản phẩm</div>
    <div class="scrolling content">
        <form class="ui form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="ui secondary menu" style="margin-top: 0px">
                <a class="item active" data-tab="first">Thông tin</a>
                <a class="item" data-tab="second">Hình ảnh</a>
            </div>
            <div class="ui tab active segment" data-tab="first">
                @include('admin.product.create.tab-info')
            </div>
            <div class="ui tab segment" data-tab="second">
                @include('admin.product.create.tab-image')
            </div>

            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>
        </form>
    </div>
</div>