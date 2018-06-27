<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Price;
use App\Product;
use App\ProductType;
use App\ProductTypeTrademark;
use App\SpecificationProductType;
use App\Trademark;
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
        $product_types = ProductType::all();
        $trademarks = Trademark::all();

        return view('admin.product.index.index', compact(['products', 'product_types', 'trademarks']));
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
            return back()->withErrors($validate)->withInput($request->all());
        }
        $price_input = str_replace(',', '', $request->get('price'));
        if ($price_input < 1000) {
            return back()->with('error', 'Giá tiền không được nhỏ hơn 1,000đ !')->withInput($request->all());
        }
        if ($price_input > 100000000) {
            return back()->with('error', 'Giá tiền không được vượt quá 100,000,000đ !')->withInput($request->all());
        }
        if (!$request->hasFile('product-image-upload') || !$request->hasFile('product-avatar-upload'))
        {
            return back()->with('error', 'Bạn chưa upload hình ảnh!')->withInput($request->all());
        }
        $product_images = $request->file('product-image-upload');
        $ext = $request->file('product-avatar-upload')->extension();
        $time = time();

        $product = new Product();
        $product_name = $request->get('product-name');
        if ($product->matchedName($product_name)) {
            return back()->with('error', 'Tên sản phẩm đã tồn tại!')->withInput($request->all());
        }
        $product->name = $product_name;
        $product->product_type_id = $request->get('product-type-id');
        $product->trademark_id = $request->get('trademark-id');
        $path = $request->file('product-avatar-upload')
            ->move('assets\img\product\avatar', "avatar-$product->id-$time.$ext");
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
        $validate = Validator::make(
            $request->all(),
            [
                "product-name-$id" => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ ]*$/")
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                "product-name-$id" => 'Tên sản phẩm'
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $product_name = $request->get("product-name-$id");

        $product = Product::findOrFail($id);
        if(($product->name != $product_name) && ($product->matchedName($product_name))) {
            return back()->with('error', 'Tên sản phẩm đã tồn tại!');
        }
        $product->name = $product_name;
        $product->product_type_id = $request->get('product-type-id');
        $product->trademark_id = $request->get('trademark-id');
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
                'price' => array('required', 'regex:/^(([1-9]\d*)|([1-9]\d{1,2}(,\d{3})*))$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'regex' => ':attribute không đúng định dạng!'
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

    public function validation(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'product-name' => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ ]*$/"),
                'price' => array('required', 'regex:/^(([1-9]\d*)|([1-9]\d{1,2}(,\d{3})*))$/')
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
