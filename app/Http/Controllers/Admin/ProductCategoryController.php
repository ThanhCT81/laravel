<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        //$page = $_GET['page'] ?? 1;
        $keyword = $request->keyword ?? '';
        $orderBy = $request->orderBy ?? 'lasted';
        $sort = $orderBy === 'lasted' ? 'desc' : 'asc';
        $status = $request->status ?? '';

        $fitler = [];
        if (!empty($keyword)) {
            $fitler[] = ['name', 'like', '%' . $keyword . '%'];
        }
        if ($status !== '') {
            $fitler[] = ['status', $status];
        }
        //Eloquent
        $productCategories = ProductCategory::where($fitler)
            ->orderBy('created_at', $sort)
            ->paginate(config('my-config.item-per-pages'));

        return view(
            'admin.pages.product_category.list',
            [
                'productCategories' => $productCategories,
                'keyword' => $keyword,
                'sortBy' => $orderBy
            ]
        );
    }
    public function create()
    {
        return view('admin.pages.product_category.add');
    }
    public function store(StoreProductCategoryRequest $request)
    {


        // $bool = DB::insert('INSERT INTO product_categories (name, status, created_at, updated_at) VALUES (?,?,?,?)', [
        //     $request->name,
        //     $request->status,
        //     Carbon::now(),
        //     Carbon::now(),
        // ]);

        //Eloquent
        $productCategory = new ProductCategory;
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $check = $productCategory->save();

        $message = $check ? 'Thành Công!!!' : 'Thất Bại';

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
