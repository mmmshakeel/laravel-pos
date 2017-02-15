<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Company;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Product;
use App\PurchaseInvoice;
use App\PurchaseInvoiceProductItems;
use App\ShippingServiceProvider;
use App\ProductBatch;
use App\ProductItemDetails;
use App\Supplier;
use App\Term;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseInvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Purchase Order List view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $purchase_invoices = PurchaseInvoice::where('is_draft', 0)->get();

        $pi_amount_array = [];
        // calculate total for each pi
        foreach ($purchase_invoices as $invoice) {
            $amount = 0;

            $tmp_array = [];

            foreach ($invoice->productInvoiceItems as $item) {
                $amount = $amount + ($item->item_count * $item->unit_cost);
            }

            $tmp_array = [
                'pi_id'     => $invoice->id,
                'pi_amount' => $amount,
            ];

            array_push($pi_amount_array, $tmp_array);
        }

        return view('purchaseinvoice.list', [
            'purchase_invoices' => $purchase_invoices,
            'pi_amounts'        => $pi_amount_array,
        ]);
    }

    public function edit($id)
    {
        $purchase_invoice = PurchaseInvoice::find($id);

        $suppliers         = Supplier::all();
        $branches          = Branch::all();
        $products          = Product::all();
        $terms             = Term::all();
        $shipping_services = ShippingServiceProvider::all();
        $user              = Auth::user();
        $currency_list     = Currency::all();

        return view('purchaseinvoice.edit', [
            'suppliers'         => $suppliers,
            'branches'          => $branches,
            'products'          => $products,
            'terms'             => $terms,
            'shipping_services' => $shipping_services,
            'user'              => $user,
            'draft_id'          => $purchase_invoice->id,
            'currency_list'     => $currency_list,
            'purchase_invoice'  => $purchase_invoice,
        ]);
    }

    public function getProductItems($pi_id)
    {
        $product_items = PurchaseInvoiceProductItems::where('purchase_invoice_id', $pi_id)
            ->get();

        $product_items_array = [];

        foreach ($product_items as $item) {
            $temp_array = [
                'product_item_id'     => $item->id,
                'product_code'        => $item->product->code,
                'product_description' => $item->product->description,
                'item_count'          => $item->item_count,
                'unit_cost'           => $item->unit_cost,
            ];

            array_push($product_items_array, $temp_array);
        }

        echo json_encode($product_items_array);
    }

    public function savePiProduct(Request $request)
    {
        // validate
        $this->validate($request, [
            'product_field_code'     => 'required',
            'product_field_ordered'  => 'required',
            'product_field_eachcost' => 'required',
        ]);

        try {
            $product_item = new PurchaseInvoiceProductItems();

            $product_item->product_id          = $request->product_field_code;
            $product_item->purchase_invoice_id = $request->pi_id;
            $product_item->item_count          = $request->product_field_ordered;
            $product_item->unit_cost           = $request->product_field_eachcost;
            $product_item->staff_id            = Auth::user()->staff->id;

            $product_item->save();

            echo 1;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'supplier' => 'required',
            'branch'   => 'required',
            'pi_terms' => 'required',
        ], [
            'pi_terms.required' => 'The terms field is required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $pi_delivery_date         = null;
        $pi_due_date              = null;
        $pi_expiry_date           = null;
        $pi_tax_invoice_date      = null;
        $pi_supplier_invoice_date = null;

        if ($request->pi_delivery_date) {
            $pi_delivery_date_arr = explode('-', $request->pi_delivery_date);
            $pi_delivery_date     = $pi_delivery_date_arr[2] . '-' . $pi_delivery_date_arr[1] . '-' . $pi_delivery_date_arr[0];
        }

        if ($request->pi_due_date) {
            $pi_due_date_arr = explode('-', $request->pi_due_date);
            $pi_due_date     = $pi_due_date_arr[2] . '-' . $pi_due_date_arr[1] . '-' . $pi_due_date_arr[0];
        }

        if ($request->pi_expiry_date) {
            $pi_expiry_date_arr = explode('-', $request->pi_expiry_date);
            $pi_expiry_date     = $pi_expiry_date_arr[2] . '-' . $pi_expiry_date_arr[1] . '-' . $pi_expiry_date_arr[0];
        }

        if ($request->pi_tax_invoice_date) {
            $pi_tax_invoice_date_arr = explode('-', $request->pi_tax_invoice_date);
            $pi_tax_invoice_date     = $pi_tax_invoice_date_arr[2] . '-' . $pi_tax_invoice_date_arr[1] . '-' . $pi_tax_invoice_date_arr[0];
        }

        if ($request->pi_supplier_invoice_date) {
            $pi_supplier_invoice_date_arr = explode('-', $request->pi_supplier_invoice_date);
            $pi_supplier_invoice_date     = $pi_supplier_invoice_date_arr[2] . '-' . $pi_supplier_invoice_date_arr[1] . '-' . $pi_supplier_invoice_date_arr[0];
        }

        try {
            DB::beginTransaction();

            $purchase_invoice = PurchaseInvoice::find($request->purchase_invoice_id);

            $purchase_invoice->supplier_id              = $request->supplier;
            $purchase_invoice->supplier_contact         = $request->supplier_contact;
            $purchase_invoice->ship_to_branch_id        = $request->branch;
            $purchase_invoice->purchase_rep             = $request->purchase_rep ? $request->purchase_rep : Auth::user()->staff->id;
            $purchase_invoice->terms_id                 = $request->pi_terms;
            $purchase_invoice->shipping_service_id      = $request->pi_ship_via;
            $purchase_invoice->delivery_date            = $pi_delivery_date;
            $purchase_invoice->due_date                 = $pi_due_date;
            $purchase_invoice->expiry_date              = $pi_expiry_date;
            $purchase_invoice->currency_id              = $request->currency;
            $purchase_invoice->tax_invoice_number       = $request->pi_tax_invoice_number;
            $purchase_invoice->tax_invoice_date         = $pi_tax_invoice_date;
            $purchase_invoice->supplier_invoice_number  = $request->pi_supplier_invoice_number;
            $purchase_invoice->supplier_invoice_date    = $pi_supplier_invoice_date;
            $purchase_invoice->shipment_tracking_number = $request->pi_shipment_tarcking_no;
            $purchase_invoice->weight_kg                = $request->pi_weight;
            $purchase_invoice->reference                = $request->pi_reference;
            $purchase_invoice->location_id              = $request->location_id ? $request->location_id : Auth::user()->branch_id;
            $purchase_invoice->is_received              = 't';
            $purchase_invoice->is_draft                 = 0;
            $purchase_invoice->save();

            // populate the inventory
            $purchase_invoice_product_items = PurchaseInvoiceProductItems::where('purchase_invoice_id', $request->purchase_invoice_id)
                ->get();

            foreach ($purchase_invoice_product_items as $item) {

                // save the product batches
                $product_batch                      = new ProductBatch();
                $product_batch->product_id          = $item->product_id;
                $product_batch->purchase_invoice_id = $request->purchase_invoice_id;
                $product_batch->batch_number        = '0000';
                $product_batch->save();

                // save the product details
                $product_item_details                   = new ProductItemDetails();
                $product_item_details->product_id       = $item->product_id;
                $product_item_details->product_batch_id = $product_batch->id;
                $product_item_details->cost             = $item->unit_cost;
                $product_item_details->price1           = 0;
                $product_item_details->item_count       = $item->item_count;
                $product_item_details->enabled          = 1;
                $product_item_details->save();

                // find the product from inventory
                $inventory = Inventory::where('product_id', $item->product_id)->first();
                if (!$inventory) {
                    $inventory = new Inventory();
                }

                $inventory->product_id      = $item->product_id;
                $inventory->available_stock = $inventory->available_stock + $item->item_count;
                $inventory->total_stock     = $inventory->total_stock + $item->item_count;
                $inventory->save();
            }

            DB::commit();
            $request->session()->flash('success', 'Purchases invoice saved!');
            return redirect()->route('purchase_invoice_list');
        } catch (Exception $ex) {
            DB::rollback();
            $request->session()->flash('fail', 'An error occured while saving purchase invoice. Please try again!');
            return back()->withInput();
        }

    }

    public function deletePiProduct(Request $request)
    {
        try {
            DB::beginTransaction();

            PurchaseInvoiceProductItems::destroy($request->id);

            // deduct one count from inventory
            $inventory = Inventory::where('product_id', $request->id)->first();

            $inventory->available_stock = $inventory->available_stock - 1;
            $inventory->total_stock     = $inventory->total_stock - 1;
            $inventory->save();

            DB::commit();
            echo 1;

        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function printPurchaseInvoice($id)
    {
        $company = Company::find(1);

        $purchase_invoice = PurchaseInvoice::find($id);

        $product_items = $purchase_invoice->productInvoiceItems;

        $product_items_array = [];

        $i        = 1;
        $po_total = 0;

        foreach ($product_items as $item) {
            $amount = $item->item_count * $item->unit_cost;
            $po_total += $amount;

            $tmp = [
                'no'                => $i,
                'product_code'      => $item->product->code,
                'product_desc'      => $item->product->description,
                'product_count'     => $item->item_count,
                'product_unit_cost' => $item->unit_cost,
                'product_amount'    => number_format($amount, 2),
            ];

            $i++;
            array_push($product_items_array, $tmp);
        }

        return view('purchaseinvoice.print', [
            'purchase_invoice' => $purchase_invoice,
            'product_items'    => $product_items_array,
            'company'          => $company,
            'po_total'         => number_format($po_total, 2),
        ]);
    }

    /**
     * Save a purchase order as draft when initializing.
     * This way we can show the purchase order number in the view
     *
     * @return int Purchase order Id / false when error
     *
     */
    private function savePurchaseInvoiceDraft()
    {
        try {
            $pi                    = new PurchaseInvoice();
            $pi->supplier_id       = 0;
            $pi->ship_to_branch_id = 0;
            $pi->purchase_rep      = Auth::user()->staff->id;
            $pi->due_date          = date('Y-m-d');
            $pi->currency_id       = 1;
            $pi->is_draft          = 1;
            $pi->save();

            return $pi->id;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Create an initial purchase invoice with some defaults values, so we can show the invoice page to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $draft = PurchaseInvoice::where('purchase_rep', Auth::user()->staff->id)
            ->where('is_draft', 1);

        $draft_count = $draft->count();

        if ($draft_count) {
            if ($draft_count > 1) {
                // delete all the drafts for the user
                PurchaseInvoice::where('purchase_rep', Auth::user()->staff->id)
                    ->where('is_draft', 1)
                    ->delete();

                // initiate a draft po
                $draft_id = $this->savePurchaseInvoiceDraft();
            } else {
                $draft_id = $draft->first()->id;
            }
        } else {
            // initiate a draft po
            $draft_id = $this->savePurchaseInvoiceDraft();
        }

        return redirect()->route('purchase_invoice_edit', ['id' => $draft_id]);
    }

    /**
     * Delete a purchase invoice and its items
     *
     * @param Request $request
     * @return type
     */
    public function destroy(Request $request) {
        try {
            $purchase_invoice = PurchaseInvoice::find($request->id);
            PurchaseInvoice::destroy($request->id);

            // now delete the sales invoice items
            PurchaseInvoiceProductItems::where('purchase_invoice_id', $request->id)->delete();

            $request->session()->flash('success', 'Purchase Invoice deleted!');
            return redirect()->route('purchase_invoice_list');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting purchase invoice. Please try again!');
            return redirect()->route('purchase_invoice_list');
        }
    }
}
