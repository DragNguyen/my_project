<div class="mini ui modal" id="modal-create-product">
    <div class="header modal-header">Thêm sản phẩm</div>
    <div class="content">
        <form class="ui form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab_content1" id="home-tab" role="tab"
                           data-toggle="tab" aria-expanded="true">Thông tin</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tab_content2" role="tab" id="profile-tab"
                           data-toggle="tab" aria-expanded="false">Hình ảnh</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        @include('admin.product.create.tab-info')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        @include('admin.product.create.tab-image')
                    </div>
                </div>
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>
        </form>
    </div>
</div>