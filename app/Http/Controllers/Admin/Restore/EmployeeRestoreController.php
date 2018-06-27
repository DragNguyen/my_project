<?php

namespace App\Http\Controllers\Admin\Restore;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Admin::where('is_deleted', true)->paginate(10);

        return view('admin.restore.employee.index', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('employee-ids')) {
            return back();
        }

        $ids = $request->get('employee-ids');
        foreach($ids as $id) {
            $employee = Admin::findOrFail($id);
            $employee->is_deleted = false;
            $employee->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
