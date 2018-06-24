<?php

namespace App\Http\Controllers\Admin\Restore;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('is_deleted', true)->paginate(10);

        return view('admin.restore.order.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('order-ids')) {
            return back();
        }
        $ids = $request->get('order-ids');
        foreach($ids as $id) {
            $order = Order::findOrFail($id);
            $order->is_deleted = false;
            $order->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
