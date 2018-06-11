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
                       value="bla bla" placeholder="Chấp nhận khoảng trắng">
            </div>
            <div class="field">
                <label>Loại sản phẩm</label>
                <select class="ui search dropdown">
                    <option value="">State</option>
                    <option value="KY">Kentucky</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <div class="field">
                <label>Thương hiệu</label>
                <input type="text" name="ten-thuong-hieu" required maxlength="100" value="bla bla">
            </div>
            <div class="field">
                <button class="ui fluid blue button" type="submit">
                    <strong>OK</strong>
                </button>
            </div>

        </form>
    </div>
</div>