<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Currency;
use App\Customer;
use App\Product;
use App\SalesInvoice;
use App\Inventory;
use App\SalesInvoiceProductItems;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class SalesInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $salesinvoices = SalesInvoice::where('is_draft', false)->get();

        return view('salesinvoice.list', [
            'salesinvoices' => $salesinvoices,
        ]);
    }

    public function create()
    {
        $draft = SalesInvoice::where('sales_rep_id', Auth::user()->staff->id)
            ->where('is_draft', 1);

        $draft_count = $draft->count();

        if ($draft_count) {
            if ($draft_count > 1) {
                // delete all the drafts for the user
                SalesInvoice::where('sales_rep_id', Auth::user()->staff->id)
                    ->where('is_draft', true)
                    ->delete();

                // initiate a draft salesinvoice
                $draft_id = $this->saveSalesInvoiceDraft();
            } else {
                $draft_id = $draft->first()->id;
            }
        } else {
            // initiate a draft salesinvoice
            $draft_id = $this->saveSalesInvoiceDraft();
        }

        return redirect()->route('edit_salesinvoice', ['id' => $draft_id]);
    }

    /**
     * Save the salesinvoice as draft, so we can show it in the edit view
     *
     * @return int/boolean
     */
    private function saveSalesInvoiceDraft()
    {
        try {
            $salesinvoice                    = new SalesInvoice();
            $salesinvoice->branch_id         = Auth::user()->branch->id;
            $salesinvoice->sales_rep_id      = Auth::user()->staff->id;
            $salesinvoice->customer_id       = 0;
            $salesinvoice->payment_method_id = 0;
            $salesinvoice->is_draft          = 1;
            $salesinvoice->save();

            return $salesinvoice->id;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function edit($id)
    {
        $salesinvoice = SalesInvoice::find($id);

        $customers     = Customer::all();
        $products      = Product::all();
        $countries     = Countries::all();
        $currency_list = Currency::all();

        return view('salesinvoice.edit-sales-invoice', [
            'customers'     => $customers,
            'products'      => $products,
            'countries'     => $countries,
            'draft_id'      => $salesinvoice->id,
            'sales_invoice' => $salesinvoice,
            'currency_list' => $currency_list,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $salesinvoice = SalesInvoice::find($request->sales_invoice_id);

            $salesinvoice->customer_id = $request->customer;
            $salesinvoice->currency_id = $request->currency_id;
            $salesinvoice->notes       = $request->quotation_notes;
            $salesinvoice->is_draft    = false;
            $salesinvoice->save();

            $request->session()->flash('success', 'Sales Invoice saved!');
            return redirect()->route('edit_salesinvoice', ['id' => $request->sales_invoice_id]);
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while saving sales invoice. Please try again!');
            return back()->withInput();
        }
    }

    public function getProductItems($id)
    {
        $quotation_items = SalesInvoiceProductItems::where('sales_invoice_id', $id)->get();

        $items_array = [];
        foreach ($quotation_items as $value) {
            array_push($items_array, [
                'id' => $value->id,
                'product_code' => $value->product->code,
                'description' => $value->product->description,
                'quantity' => $value->qty,
                'sale_price' => $value->sale_price,
                'price' => $value->price,
                'discount' => $value->discount,
                'price_level' => $value->price_level
            ]);
        }

        echo json_encode($items_array);
    }

    /**
     * Save a product item for the sales invoice
     *
     * @param  Request $request [description]
     * @return string           echo a json string as ajax call response
     */
    public function saveSalesInvoiceProduct(Request $request)
    {
        // validate
        $this->validate($request, [
            'sales_invoice_id' => 'required',
            'product_id'       => 'required',
            'price_level'      => 'required',
            'sale_price'       => 'required',
            'quantity'         => 'required',
        ]);

        try {
            DB::beginTransaction();

            $sip_item                   = new SalesInvoiceProductItems();
            $sip_item->sales_invoice_id = $request->sales_invoice_id;
            $sip_item->product_id       = $request->product_id;
            $sip_item->price_level      = $request->price_level;
            $sip_item->price            = $request->price;
            $sip_item->discount         = $request->discount;
            $sip_item->sale_price       = $request->sale_price;
            $sip_item->qty              = $request->quantity;
            $sip_item->save();

            // now reduce from the inventory
            $inventory                  = Inventory::where('product_id', $request->product_id)->first();
            $inventory->available_stock = ($inventory->available_stock - (int) $request->quantity);
            $inventory->total_stock     = ($inventory->total_stock - (int) $request->quantity);
            $inventory->save();

            DB::commit();

            echo 'SUCCESS';
        } catch (\Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
        }
    }

}
