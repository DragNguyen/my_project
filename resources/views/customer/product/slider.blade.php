@push('style')
    <style>
        .sp-wrap {
            margin: auto;
            width: 100% !important;
            height: 300px;
            background: none !important;
            border: none !important;
        }
        .sp-large{
            height: 270px !important;
        }
    </style>
@endpush

<link rel="stylesheet" href="{{ asset('style/plugin/zoom/smooth-products/smoothproducts.css') }}">

<div class="sp-wrap">
    <a href="/{{ $product->avatar }}">
        <img width="100%" src="/{{ $product->avatar }}" alt="">
    </a>
    @foreach($product->images as $image)
        <a href="/{{ $image->link }}">
            <img src="/{{ $image->link }}" alt="">
        </a>
    @endforeach
</div>

@push('script')
    <script>
        $('.sp-wrap').smoothproducts();
    </script>
@endpush