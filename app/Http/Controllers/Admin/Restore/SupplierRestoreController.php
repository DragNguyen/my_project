<?php

namespace App\Http\Controllers\Admin\Restore;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::where('is_deleted', true)->paginate(10);

        return view('admin.restore.supplier.index', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('supplier-ids')) {
            return back();
        }
        $ids = $request->get('supplier-ids');
        foreach($ids as $id) {
            $supplier = Supplier::findOrFail($id);
            $supplier->is_deleted = false;
            $supplier->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
