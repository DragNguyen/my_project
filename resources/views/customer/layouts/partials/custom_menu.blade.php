<div class="ui labeled input" style="min-width: 240px">
    <div class="ui label">
        Thương hiệu
    </div>
    <select class="ui fluid search selection dropdown" name="dashboard" onchange="this.form.submit()">
        <option value="all">Tất cả</option>
        @foreach(\App\Trademark::all() as $trademark)
            <option value="{{ $trademark->id }}">
                {{ $trademark->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="ui labeled input" style="min-width: 330px">
    <div class="ui label">
        Giá
    </div>
    <select class="ui fluid selection dropdown" name="dashboard" onchange="this.form.submit()">
        <option value="all">Tất cả</option>
        <option value="5">Dưới 5 triệu</option>
        <option value="5-10">Từ 5 - 10 triệu</option>
        <option value="10-15">Từ 10 - 15 triệu</option>
        <option value="15-20">Từ 15 - 20 triệu</option>
        <option value="20">Trên 20 triệu</option>
    </select>
    <select class="ui fluid selection dropdown" name="dashboard">
        <option value="asc">Tăng dần</option>
        <option value="desc">Giảm dần</option>
    </select>
</div>