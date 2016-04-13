<?php

namespace App\Http\Controllers;

use App\SalesInvoice;
use App\Customer;
use App\Product;
use App\Countries;
use App\Inventory;
use App\Currency;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            'sales_invoice'  => $salesinvoice,
            'currency_list' => $currency_list,
        ]);
    }
}
