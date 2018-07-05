<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Price;
use App\Product;
use App\ProductType;
use App\ProductTypeTrademark;
use App\Quantity;
use App\SpecificationProductType;
use App\Trademark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trademarks = Trademark::all();
        $key_filter = '';
        $key_search = '';
        $products = Product::where('is_deleted', false)->paginate(10);
        if ($request->has('key-filter')) {
            $key_filter_input = explode('-', $request->get('key-filter'));
            if (count($key_filter_input) == 1) {
                $products = Product::where('is_deleted', false)
                    ->where('product_type_trademark_id', $key_filter_input[0])->paginate(10);
                $key_filter = $key_filter_input[0];
            }
            else {
                $ids = [];
                foreach(Trademark::find($key_filter_input[1])->productTypeTrademarks as $product_type_trademark) {
                    array_push($ids, $product_type_trademark->id);
                }
                $products = Product::where('is_deleted', false)
                    ->whereIn('product_type_trademark_id', $ids)->paginate(10);
                $key_filter = 'all-'.$key_filter_input[1];
            }
        }
        if (!empty($request->get('key-search'))) {
            $key_search = $request->get('key-search');
            $products = Product::where('is_deleted', false)
                ->where('name', 'like', "%$key_search%")->paginate(10);
        }
        return view('admin.product.index.index',
            compact(['products', 'trademarks', 'key_filter', 'key_search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validationStore($request);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->only('price', 'product-name'));
        }
        if (!$request->has('product-type-trademark-id')) {
            return back()->withInput($request->only('price', 'product-name'))
                ->withErrors(['product-type-trademark-id' => 'Bạn chưa chọn thương hiệu - loại sản phẩm!']);
        }
        $price_input = str_replace(',', '', $request->get('price'));
        if ($price_input < 1000) {
            return back()->withErrors(['price' => 'Giá tiền không được nhỏ hơn 1,000đ !'])
                ->withInput($request->only('price', 'product-name'));
        }
        if ($price_input > 100000000) {
            return back()->withErrors(['price' => 'Giá tiền không được vượt quá 100,000,000đ !'])
                ->withInput($request->only('price', 'product-name'));
        }
        if (!$request->hasFile('product-image-upload') || !$request->hasFile('product-avatar-upload'))
        {
            return back()->withErrors(['Bạn chưa upload hình ảnh!'])
                ->withInput($request->only('price', 'product-name'));
        }
        $product_images = $request->file('product-image-upload');
        $ext = $request->file('product-avatar-upload')->extension();
        $time = time();

        $product = new Product();
        $product_name = $request->get('product-name');
        if ($product->matchedName($product_name)) {
            return back()->with('error', 'Tên sản phẩm đã tồn tại!')->withInput($request->only('price', 'product-name'));
        }
        $product->name = $product_name;
        $product->product_created_at = date('Y-m-d H:i:s');
        $product->product_type_trademark_id = $request->get('product-type-trademark-id');
        $product->slug = str_slug($product_name);
        $path = $request->file('product-avatar-upload')
            ->move('assets\img\product\avatar', "avatar-$product->id-$time.$ext");
        $product->avatar = str_replace('\\', '/', $path);
        $product->save();

        $price = new Price();
        $price->price = $price_input;
        $price->price_updated_at = date('Y-m-d H:i:s');
        $price->product_id = $product->id;
        $price->save();

        $quantity = new Quantity();
        $quantity->product_id = $product->id;
        $quantity->save();

        foreach ($product_images as $key => $product_image) {
            $ext = $product_image->extension();
            $image = new Image();
            $image->product_id = $product->id;
            $path = $product_image->move('assets\img\product\image', "image-$product->id-$key-$time.$ext");
            $image->link = str_replace('\\', '/', $path);
            $image->save();
        }

        return back()->with('success', 'Thêm thành công.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $images = $product->images;
        $specs = SpecificationProductType::where('product_type_id', $product->product_type_id)->get();
        $trademarks = Trademark::all();

        return view('admin.product.show.index', compact(['product', 'images', 'specs', 'trademarks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $this->validationUpdate($request, $id);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $product_name = $request->get("product-name-$id");
        $product_type_trademark_id = $request->get('product-type-trademark-id');
        $product = Product::findOrFail($id);
        if (($product_name == $product->name)
            && ($product_type_trademark_id==$product->product_type_trademark_id)) {
            return back();
        }
        if(($product->name != $product_name) && ($product->matchedName($product_name))) {
            return back()->with('error', 'Tên sản phẩm đã tồn tại!');
        }
        $product->name = $product_name;
        $product->slug = str_slug($product_name);
        $product->product_type_trademark_id = $request->get('product-type-trademark-id');
        $product->product_updated_at = date('Y-m-d H:i:s');

        $product->update();

        return back()->with('success', 'Sửa thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->has('product-ids')) {
            return back();
        }
        $ids = $request->get('product-ids');
        foreach($ids as $id) {
            $product = Product::findOrFail($id);
            if ($product->canDelete()) {
                $product->delete();
            }
            else {
                $product->is_deleted = true;
                $product->update();
            }
        }

        return back()->with('success', 'Xóa thành công.');
    }

    public function changePrice(Request $request, $id) {
        $validate = Validator::make($request->all(),
            [
                'price' => array('required', 'regex:/^(([1-9]\d*)|([1-9]\d{0,2}(,\d{3})*))$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                'price' => 'Giá tiền'
            ]
        );
        if($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->only('price'));
        }
        $price_input = str_replace(',', '', $request->get('price'));
        if ($price_input > 100000000) {
            return back()->withErrors(['price' => 'Giá tiền không được vượt quá 100,000,000đ !']);
        }
        if ($price_input < 1000) {
            return back()->withErrors(['price' => 'Giá tiền không được vượt quá 100,000,000đ !']);
        }

        $price = new Price();
        $price->price = $price_input;
        $price->product_id = $id;
        $price->price_updated_at = date('Y-m-d H:i:s');
        $price->save();

        return back()->with('success', 'Thay đổi thành công.');
    }

    public function validationStore(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'product-name' => array('required', 'max:100', "regex:/^[A-ỹ][0-ỹ ]*$/"),
                'price' => array('required', 'regex:/^(([1-9]\d*)|([1-9]\d{0,2}(,\d{3})*))$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                'product-name' => 'Tên sản phẩm',
                'price' => 'Giá tiền'
            ]
        );

        return $validate;
    }

    public function validationUpdate(Request $request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "product-name-$id" => array('required', 'max:100', "regex:/^[A-ỹ][0-ỹ ]*$/"),
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                "product-name-$id" => 'Tên sản phẩm'
            ]
        );

        return $validate;
    }
}
