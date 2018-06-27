<?php

namespace App\Http\Controllers\Admin\Restore;

use App\Trademark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrademarkRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trademarks = Trademark::where('is_deleted', true)->paginate(10);

        return view('admin.restore.trademark.index', compact('trademarks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('trademark-ids')) {
            return back();
        }

        $ids = $request->get('trademark-ids');
        foreach($ids as $id) {
            $trademark = Trademark::findOrFail($id);
            $trademark->is_deleted = false;
            $trademark->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
