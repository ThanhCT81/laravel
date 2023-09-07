<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        //$page = $_GET['page'] ?? 1;
        $keyword = $request->keyword;
        // $result = DB::select('select * from product_categories where name like ? order by created_at desc', ['%' . $keyword . '%']);
        $page = $request->page ?? 1;
        $itemPerPage = 2;
        $offset = ($page - 1) * $itemPerPage;
        $productCategories = DB::select(
            'select * from product_categories where name like ? order by created_at desc limit ?,?',
            [
                '%' . $keyword . '%',
                $offset,
                $itemPerPage
            ]
        );
        //$productCategories = DB::select('select * from product_categories');
        $totalRecords = DB::select('select count(*) as sum from product_categories')[0]->sum;
        $totalPage = ceil($totalRecords / $itemPerPage);
        return view(
            'admin.pages.product_category.list',
            [
                'productCategories' => $productCategories,
                'totalPage' => $totalPage,
                'currentPage' => $page
            ]
        );
    }
    public function create()
    {
        return view('admin.pages.product_category.add');
    }
    public function store(StoreProductCategoryRequest $request)
    {


        $bool = DB::insert('INSERT INTO product_categories (name, status, created_at, updated_at) VALUES (?,?,?,?)', [
            $request->name,
            $request->status,
            Carbon::now(),
            Carbon::now(),
        ]);

        $message = $bool ? 'Thành Công!!!' : 'Thất Bại';

        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
    public function detail($id)
    {
        $productCategory = DB::select('select * from product_categories where id = ?', [$id]);
        return view('admin.pages.product_category.detail', ['productCategory' => $productCategory[0]]);
    }
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $check = DB::update('update product_categories set name = ? , status = ? , updated_at =? where id = ?', [
            $request->name,
            $request->status,
            Carbon::now(),
            $id
        ]);

        $message = $check > 0 ? 'Cập nhật thành công!!!' : 'Cập nhật thất bại';

        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
    public function destroy($id)
    {
        $check = DB::delete('delete from product_categories where id = ?', [$id]);
        $message = $check > 0 ? 'Xóa thành công!!!' : 'Xóa thất bại';
        return redirect()->route('admin.product_category.list')->with('message', $message);
    }
}
