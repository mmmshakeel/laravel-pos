<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\ProductModel;
use App\Brand;
use App\Product;
use App\Branch;
use App\ProductType;

class ProductController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get product categories
        $categories = Category::all();

        // get product models
        $models = ProductModel::all();

        // get product brands
        $brands = Brand::all();

        // get all products
        $products = Product::all();

        return view('product.product', [
            'categories' => $categories,
            'models' => $models,
            'brands' => $brands,
            'products' => $products
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $branches = Branch::all();
        $categories = Category::all();
        $models = ProductModel::all();
        $brands = Brand::all();
        $product_types = ProductType::all();

        $params = [
            'branches' => $branches,
            'categories' => $categories,
            'models' => $models,
            'brands' => $brands,
            'product_types' => $product_types
        ];

        return view('product.product-addproduct', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'code' => 'required|unique:product',
            'branch_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'cost' => 'required',
            'price_level1' => 'required',
            'product_type_id' => 'required',
            'active_status' => 'required',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
