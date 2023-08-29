<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    //
    public function index()
    {
        $productCategories = DB::select('select * from product_categories');
        return view('admin.pages.product_category.list', ['productCategories' => $productCategories]);
    }
    public function create()
    {
        return view('admin.pages.product_category.add');
    }
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|min:3|max:255|unique:product_categories,name',
            'status' => 'required'
        ], [
            'name.required' => 'Vui lòng điền tên!!!',
            'name.min' => 'Tên phải trên 3 kí tự!!!',
            'name.max' => 'Tên phải dưới 255 kí tự!!!',
            'status.required' => 'Vui lòng chọn trạng thái!!!'
        ]);

        $bool = DB::insert('INSERT INTO product_categories (name, status, created_at, updated_at) VALUES (?,?,?,?)', [
            $request->name,
            $request->status,
            Carbon::now(),
            Carbon::now(),
        ]);

        $message = $bool ? 'Thành Công!!!' : 'Thất Bại';

        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
    public function detail()
    {
        dd(1);
    }
}
