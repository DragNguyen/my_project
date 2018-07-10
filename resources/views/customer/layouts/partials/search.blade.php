@php $products = \App\Product::all() @endphp

<div class="ui basic segment left floated no-margin">
    <div class="ui search computer">
        <div class="ui icon small input">
            <input type="text" class="prompt" placeholder="Nhập từ khóa tìm kiếm, ít nhất 3 ký tự ">
            <i class="search icon"></i>
        </div>
        <div class="results">
            <div class="results transition visible" style="display: block !important;">
                <a class="result" href="/chi-tiet/dell-laptop402">
                    <div class="image">
                        <img src="/assets/images\uploaded/products\ssd\153095089434.jpg">
                    </div>
                    <div class="content">
                        <div class="price">1,300,000đ</div>
                        <div class="title">Dell laptop</div>
                    </div></a><a class="result" href="/chi-tiet/ban-phim-dell-d-600">
                    <div class="image">
                        <img src="/assets/images/uploaded/products/keyboard/dell-d-600.jpg">
                    </div><div class="content"><div class="price">100,000đ</div>
                        <div class="title">Bàn phím Dell D-600</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .ui.search>.results .result .image img {
        width: 40px;
    }
</style>

@push('script')
    <script>
        var
            content = [
                @foreach($products as $product)
                    {
                        title: "{{ $product->getName() }}",
                        price: "{!! number_format($product->currentPrice()).'<sup>đ</sup>' !!}",
                        image: "/{{ $product->avatar }}",
                        url: "/product/{{ $product->slug }}"
                    },
                @endforeach
            ]
        ;
        $('.ui.search')
            .search({
                source : content,
                searchFields   : [
                    'title'
                ],
                fullTextSearch: true,
                minCharacters: 3
            })
        ;
    </script>
@endpush