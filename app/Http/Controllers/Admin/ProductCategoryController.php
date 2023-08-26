<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.product_category.list');
    }
    public function create()
    {
        return view('admin.pages.product_category.add');
    }
}
