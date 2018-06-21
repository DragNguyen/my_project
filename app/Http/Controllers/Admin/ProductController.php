<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Price;
use App\Product;
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
        $products = Product::paginate(10);

        return view('admin.product.index.index', compact('products'));
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
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        if (!$request->hasFile('product-image-upload') || !$request->hasFile('product-avatar-upload'))
        {
            return back();
        }
        $product_images = $request->file('product-image-upload');
        $ext = $request->file('product-avatar-upload')->extension();

        $product = new Product();
        $product->name = $request->get('product-name');
        $product->product_type_id = $request->get('product-type-name');
        $product->trademark_id = $request->get('trademark-name');
        $path = $request->file('product-avatar-upload')
            ->move('assets\img\product\avatar', "avatar-$product->id.$ext");
        $product->avatar = str_replace('\\', '/', $path);
        $product->save();

        $price = new Price();
        $price->price = str_replace(' ', '', $request->get('price'));
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

        return back()->with('success', 'Thêm sản phẩm thành công.');


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
        $product = Product::findOrFail($id);
        $product->name = $request->get('product-name');
        $product->product_type_id = $request->get('product_type_name');
        $product->trademark_id = $request->get('trademark_id');

        $product->update();

        return back()->with('success', 'Sửa thông tin sản phẩm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validation(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'product-name' => 'required|max:100',
                'price' => 'required'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!'
            ],
            [
                'product-name' => 'Tên sản phẩm',
                'price' => 'Giá tiền'
            ]
        );

        return $validate;
    }
}
