<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Product;
use App\ProductBatch;
use App\ProductItemDetails;
use App\ProductModel;
use App\ProductType;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get product categories
        $categories = Category::all();

        // get product models
        $models = ProductModel::all();

        // get product brands
        $brands = Brand::all();

        $products = Product::all();

        return view('product.product', [
            'categories' => $categories,
            'models'     => $models,
            'brands'     => $brands,
            'products'   => $products,
            'request'    => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches      = Branch::all();
        $categories    = Category::all();
        $models        = ProductModel::all();
        $brands        = Brand::all();
        $product_types = ProductType::all();

        $params = [
            'branches'      => $branches,
            'categories'    => $categories,
            'models'        => $models,
            'brands'        => $brands,
            'product_types' => $product_types,
        ];

        return view('product.product-addproduct', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code'            => 'required|unique:product',
            'branch_id'       => 'required',
            'category_id'     => 'required',
            'brand_id'        => 'required',
            'model_id'        => 'required',
            'product_type_id' => 'required',
            'active_status'   => 'required',
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
            $product->average_cost    = $request->average_cost;
            $product->rack_id         = $request->rack_id;
            $product->product_type_id = $request->product_type_id;
            $product->active_status   = $request->active_status;
            $product->save();

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
    public function show($id)
    {
        $product              = Product::find($id);
        $product_item_details = ProductItemDetails::where('product_id', $id)->get();

        $inventory_stock_total = 0;

        if ($product->inventory) {
            $inventory_stock_total = $product->inventory->total_stock;
        }

        return view('product.product-showproduct', [
            'product'               => $product,
            'inventory_stock_total' => $inventory_stock_total,
            'product_item_details'  => $product_item_details,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories    = Category::all();
        $models        = ProductModel::all();
        $brands        = Brand::all();
        $branches      = Branch::all();
        $product_types = ProductType::all();

        $product = Product::find($id);

        return view('product.product-editproduct', [
            'branches'      => $branches,
            'categories'    => $categories,
            'models'        => $models,
            'brands'        => $brands,
            'product_types' => $product_types,
            'product'       => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'code'            => 'required|unique:product,code,' . $request->id,
            'branch_id'       => 'required',
            'category_id'     => 'required',
            'brand_id'        => 'required',
            'model_id'        => 'required',
            'product_type_id' => 'required',
            'active_status'   => 'required',
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
            $product->average_cost    = $request->average_cost;
            $product->rack_id         = $request->rack_id;
            $product->product_type_id = $request->product_type_id;
            $product->active_status   = $request->active_status;
            $product->save();

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
    public function destroy(Request $request)
    {
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

    public function getProductStock($id)
    {
        $product = Product::find($id);

        echo json_encode([
            'total_stock'     => $product->inventory->total_stock,
            'available_stock' => $product->inventory->available_stock,
        ]);
    }

    /**
     * Get product description by given product id
     *
     * @param  int $id Product Id
     * @return string     Product description
     */
    public function getProductDescription($id)
    {
        echo Product::find($id)->description;
    }


    public function getAllProductItemsByProduct($id)
    {
        $product_items = ProductItemDetails::where('product_id', $id);

        $total_item_count = $product_items->count();

        $rows = [];

        if ($total_item_count > 0) {
            foreach ($product_items->get() as $item) {
                $rows[] = [
                    'id'          => $item->id,
                    'batch_id'    => $item->product_batch->batch_number,
                    'barcode'     => $item->barcode,
                    'expiry_date' => $item->expiry_date,
                    'stock_count' => $item->item_count,
                    'cost'        => $item->cost,
                    'price'       => $item->price1,
                ];
            }
        }

        return response()->json([
            'current'  => 1,
            'rowCount' => 10,
            'rows'     => $rows,
            'total'    => $total_item_count
        ]);

    }

    /**
     * Get the product item details of a product
     *
     * @param  int
     * @return json
     */
    public function getProductItemDetails($id)
    {
        $product_item_details = ProductItemDetails::find($id);

        if (!$product_item_details) {
            return response('Resource not found', 401);
        }

        return response()->json([
            'batch_number' => $product_item_details->product_batch->batch_number,
            'barcode'      => $product_item_details->barcode,
            'expiry_date'  => $product_item_details->expiry_date,
            'price1'       => $product_item_details->price1,
            'price2'       => $product_item_details->price2,
            'price3'       => $product_item_details->price3,
            'cost'         => $product_item_details->cost,
            'item_count'   => $product_item_details->item_count,
            'id'           => $product_item_details->id,
        ]);
    }

    public function updateBatch(Request $request)
    {
        $product_item_details = ProductItemDetails::find($request->product_item_id);

        $this->validate($request, [
            'batch_number' => 'required|unique:product_batch,batch_number,' . $product_item_details->product_batch->id,
            'price1'       => 'required',
        ]);

        try {
            DB::beginTransaction();

            // update product batch
            $product_batch               = ProductBatch::find($product_item_details->product_batch->id);
            $product_batch->batch_number = $request->batch_number;
            $product_batch->save();

            if ($request->expiry_date) {
                $expiry_date_arr = explode('-', $request->expiry_date);
                $expiry_date     = $expiry_date_arr[2] . '-' . $expiry_date_arr[1] . '-' . $expiry_date_arr[0];
            }

            $product_item_details->barcode     = $request->barcode;
            $product_item_details->expiry_date = $expiry_date;
            $product_item_details->price1      = $request->price1;
            $product_item_details->price2      = $request->price2;
            $product_item_details->price3      = $request->price3;
            $product_item_details->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

}
