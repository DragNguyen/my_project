<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Price;
use App\Product;
use App\ProductTypeTrademark;
use App\SpecificationProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_deleted', false)->paginate(10);
        $product_type_trademarks = ProductTypeTrademark::all();

        return view('admin.product.index.index', compact(['products', 'product_type_trademarks']));
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
        $validate = $this->validation($request);
        if (empty($request->get('product-type-trademark-name'))) {
            return back()->with('error', 'Bạn chưa chọn thương hiệu - loại sản phẩm!');
        }
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $price_input = str_replace(',', '', $request->get('price'));
        if ($price_input < 1000) {
            return back()->with('error', 'Giá tiền không được nhỏ hơn 1,000đ !');
        }
        if (!$request->hasFile('product-image-upload') || !$request->hasFile('product-avatar-upload'))
        {
            return back()->with('error', 'Bạn chưa upload hình ảnh!');
        }
        $product_images = $request->file('product-image-upload');
        $ext = $request->file('product-avatar-upload')->extension();

        $product = new Product();
        $product->name = $request->get('product-name');
        $product->product_type_trademark_id = $request->get('product-type-trademark-name');
        $path = $request->file('product-avatar-upload')
            ->move('assets\img\product\avatar', "avatar-$product->id.$ext");
        $product->avatar = str_replace('\\', '/', $path);
        $product->save();

        $price = new Price();
        $price->price = $price_input;
        $price->product_id = $product->id;
        $price->save();

        foreach ($product_images as $key => $product_image) {
            $ext = $product_image->extension();
            $image = new Image();
            $image->product_id = $product->id;
            $path = $product_image->move('assets\img\product\image', "image-$product->id-$key.$ext");
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

        return view('admin.product.show.index', compact(['product', 'images', 'specs']));
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
        $validate = $this->validation($request);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $product = Product::findOrFail($id);
        $product->name = $request->get('product-name');
        $product->product_type_trademark_id = $request->get('product_type_trademark_name');

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

    public function validation(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'product-name' => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ ]*$/"),
                'price' => array('required', "regex:/^\d[\d,]*\d$/")
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                'product-name' => 'Tên sản phẩm',
                'price' => 'Giá tiền'
            ]
        );

        return $validate;
    }
}
