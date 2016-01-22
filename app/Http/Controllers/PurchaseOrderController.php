<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Supplier;
use App\Branch;
use App\Product;

class PurchaseOrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $suppliers = Supplier::all();
        $branches = Branch::all();
        $products = Product::all();

        return view('purchaseorder.new-po', [
            'suppliers' => $suppliers,
            'branches' => $branches,
            'products' => $products
        ]);
    }

    public function getSupplierDetailsById($id) {
        $supplier = Supplier::find($id);

        echo json_encode([
            'code' => $supplier->code,
            'company_name' => $supplier->company_name,
            'address' => $supplier->address,
            'city' => $supplier->city,
//            'country' => $supplier->country->country_name
        ]);
    }

    public function getBranchDetailsById($id) {
        $branch = Branch::find($id);

        echo json_encode([
            'code' => $branch->code,
            'desc' => $branch->description,
            'address' => $branch->address,
            'city' => $branch->city,
//            'country' => $supplier->country->country_name
        ]);
    }

    public function getProductDescription($id) {
        $product = Product::find($id);

        echo $product->description;
    }

}
