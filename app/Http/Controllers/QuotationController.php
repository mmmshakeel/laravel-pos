<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Product;
use App\Quotation;
use App\Countries;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $draft = Quotation::where('sales_rep', Auth::user()->staff->id)
            ->where('is_draft', 1);

        $draft_count = $draft->count();

        if ($draft_count) {
            if ($draft_count > 1) {
                // delete all the drafts for the user
                Quotation::where('sales_rep', Auth::user()->staff->id)
                    ->where('is_draft', 1)
                    ->delete();

                // initiate a draft quotation
                $draft_id = $this->saveQuotationDraft();
            } else {
                $draft_id = $draft->first()->id;
            }
        } else {
            // initiate a draft quotation
            $draft_id = $this->saveQuotationDraft();
        }

        return redirect()->route('edit_quotation', ['id' => $draft_id]);
    }

    private function saveQuotationDraft()
    {
        try {
            $quotation              = new Quotation();
            $quotation->branch_id   = Auth::user()->branch->id;
            $quotation->sales_rep   = Auth::user()->staff->id;
            $quotation->customer_id = 0;
            $quotation->is_draft    = 1;
            $quotation->save();

            return $quotation->id;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function edit($id)
    {
        $quotation = Quotation::find($id);

        $customers = Customer::all();
        $products  = Product::all();
        $countries = Countries::all();

        return view('quotation.editquotation', [
            'customers' => $customers,
            'products'  => $products,
            'countries' => $countries,
            'draft_id'  => $quotation->id,
            'quotation' => $quotation,
        ]);
    }
}
