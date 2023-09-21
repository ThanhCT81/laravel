<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $products = DB::table('products')
        //     ->select('products.*', 'product_categories.name as product_category_name')
        //     ->leftJoin('product_categories', 'products.product_category_id', '=', 'product_categories.id')
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(config('my-config.item-per-pages'));

        //Eloquent
        $products = Product::withTrashed()->paginate(config('my-config.item-per-pages'));

        return view('admin.pages.product.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = DB::select('select * from product_categories where status = 1');
        return view('admin.pages.product.add', ['productCategories' => $productCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $fileOriginalName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName .= '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(public_path('images'), $fileName);
        }

        //Query Builder
        $check = DB::table('products')->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "discount_price" => $request->discount_price,
            "short_description" => $request->short_description,
            "qty" => $request->qty,
            "shipping" => $request->shipping,
            "weight" => $request->weight,
            "description" => $request->description,
            "information" => $request->information,
            "image" => $request->image,
            "status" => $request->status,
            "product_category_id" => $request->product_category_id,
            "image" => $fileName ?? null,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
        $messager = $check ? 'Tao san pham thanh cong' : 'Tao san pham that bai';
        return redirect()->route('admin.product.index')->with('message', $messager);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = DB::table('products')->find($id);
        $productCategories = DB::table('product_categories')->where('status', '=', 1)->get();
        return view('admin.pages.product.detail', ['product' => $product, 'productCategories' => $productCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = DB::table('products')->find($id);
        $oldImageFileName = $product->image;

        if ($request->hasFile('image')) {
            $fileOriginalName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName .= '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $fileName);

            if (!is_null($oldImageFileName) && file_exists('images/' . $oldImageFileName)) {
                unlink('images/' . $oldImageFileName);
            }
        }

        $check = DB::table('products')->where('id', '=', $id)->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "discount_price" => $request->discount_price,
            "short_description" => $request->short_description,
            "qty" => $request->qty,
            "shipping" => $request->shipping,
            "weight" => $request->weight,
            "description" => $request->description,
            "information" => $request->information,
            "image" => $request->image,
            "status" => $request->status,
            "product_category_id" => $request->product_category_id,
            "image" => $fileName ?? $oldImageFileName,
            "updated_at" => Carbon::now()
        ]);
        $messager = $check ? 'Cap nhat san pham thanh cong' : 'Cap nhat san pham that bai';
        return redirect()->route('admin.product.index')->with('message', $messager);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = DB::table('products')->find($id);
        $image = $product->image;
        if (!is_null($image) && file_exists('images/' . $image)) {
            unlink('images/' . $image);
        }

        // $check = DB::table('products')->delete($id);
        $productData = Product::find((int)$id);
        $productData->delete();

        return redirect()->route('admin.product.index')->with('message', 'xoa san pham thanh cong');
    }
    public function createSlug(Request $request)
    {
        $slug = Str::slug($request->name, '-');
        return response()->json(['slug' => $slug]);
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $url = asset('images/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    public function restore(string $id)
    {
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('admin.product.index')->with('message', 'khoi phuc san pham thanh cong');
    }
}
