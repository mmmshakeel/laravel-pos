<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Category;
use App\ProductModel;
use App\Brand;
use App\Product;
use App\Branch;
use App\ProductType;
use App\Inventory;

class ProductController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // get product categories
        $categories = Category::all();

        // get product models
        $models = ProductModel::all();

        // get product brands
        $brands = Brand::all();

        $products = Product::all();

        return view('product.product', [
            'categories' => $categories,
            'models' => $models,
            'brands' => $brands,
            'products' => $products,
            'request' => $request
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

        try {
            DB::beginTransaction();

            $product = new Product();

            $product->code            = $request->code;
            $product->description     = $request->description;
            $product->category_id     = $request->category_id;
            $product->brand_id        = $request->brand_id;
            $product->model_id        = $request->model_id;
            $product->branch_id       = $request->branch_id;
            $product->cost            = $request->cost;
            $product->average_cost    = $request->average_cost;
            $product->price_level1    = $request->price_level1;
            $product->price_level2    = $request->price_level2;
            $product->price_level3    = $request->price_level3;
            $product->price_level4    = $request->price_level4;
            $product->total_stock     = $request->total_stock;
            $product->rack_id         = $request->rack_id;
            $product->product_type_id = $request->product_type_id;
            $product->active_status   = $request->active_status;

            $product->save();

            // now populate the inventory
            $inventory = new Inventory();
            $inventory->product_id = $product->id;
            $inventory->minimum_stock = $request->minimum_stock;
            $inventory->save();

            DB::commit();

            $request->session()->flash('success', 'Product ' . $request->code . ' saved!');
            return redirect()->route('product_list');
        } catch (\Exception $e) {
            DB::rollback();

            $request->session()->flash('fail', 'An error occured while saving product ' . $request->code . '. Please try again!');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Product::find($id);

        return view('product.product-showproduct', [
            'product' => $product
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $categories = Category::all();
        $models = ProductModel::all();
        $brands = Brand::all();
        $branches = Branch::all();
        $product_types = ProductType::all();

        $product = Product::find($id);

        return view('product.product-editproduct', [
            'branches' => $branches,
            'categories' => $categories,
            'models' => $models,
            'brands' => $brands,
            'product_types' => $product_types,
            'product' => $product
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $this->validate($request, [
            'code' => 'required|unique:product,code,' . $request->id,
            'branch_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'cost' => 'required',
            'price_level1' => 'required',
            'product_type_id' => 'required',
            'active_status' => 'required',
            ]);

        try {
            DB::beginTransaction();

            $product = Product::find($request->id);

            $product->code            = $request->code;
            $product->description     = $request->description;
            $product->category_id     = $request->category_id;
            $product->brand_id        = $request->brand_id;
            $product->model_id        = $request->model_id;
            $product->branch_id       = $request->branch_id;
            $product->cost            = $request->cost;
            $product->average_cost    = $request->average_cost;
            $product->price_level1    = $request->price_level1;
            $product->price_level2    = $request->price_level2;
            $product->price_level3    = $request->price_level3;
            $product->price_level4    = $request->price_level4;
            $product->total_stock     = $request->total_stock;
            $product->rack_id         = $request->rack_id;
            $product->product_type_id = $request->product_type_id;
            $product->active_status   = $request->active_status;

            $product->save();

            // now populate the inventory
            // find the product from inventory
            $inventory = Inventory::where('product_id', $product->id)->first();
            if (!$inventory) {
                $inventory = new Inventory();
            }
            $inventory->product_id = $product->id;
            $inventory->minimum_stock = $request->minimum_stock;
            $inventory->save();

            DB::commit();

            $request->session()->flash('success', 'Product ' . $request->code . ' updated!');
            return redirect()->route('product_list');
        } catch (\Exception $e) {
            DB::rollback();

            $request->session()->flash('fail', 'An error occured while updating product ' . $request->code . '. Please try again!');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {

        try {
            $product = Product::find($request->id);
            Product::destroy($request->id);

            $request->session()->flash('success', 'Product ' . $product->code . ' deleted!');
            return redirect()->route('product_list');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting product ' . $product->code . '. Please try again!');
            return redirect()->route('product_list');
        }

    }

}
