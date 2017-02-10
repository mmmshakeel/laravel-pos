<?php

namespace App\Http\Controllers;

use App\Company;
use App\Country;
use App\Currency;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Product;
use App\Quotation;
use App\QuotationItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $quotations = Quotation::where('is_draft', false)->get();

        return view('quotation.list', [
            'quotations' => $quotations,
        ]);
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

    /**
     * Save the quotation as draft, so we can show it in the edit view
     *
     * @return int/boolean
     */
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

        $customers     = Customer::all();
        $products      = Product::all();
        $countries     = Country::all();
        $currency_list = Currency::all();

        return view('quotation.editquotation', [
            'customers'     => $customers,
            'products'      => $products,
            'countries'     => $countries,
            'draft_id'      => $quotation->id,
            'quotation'     => $quotation,
            'currency_list' => $currency_list,
        ]);
    }

    /**
     * Save a product item for the quotaiton
     *
     * @param  Request $request [description]
     * @return string           echo a json string as ajax call response
     */
    public function saveQuotationProduct(Request $request)
    {
        // validate
        $this->validate($request, [
            'quotation_id' => 'required',
            'product_id'   => 'required',
            'price_level'  => 'required',
            'sale_price'   => 'required',
            'quantity'     => 'required',
        ]);

        try {
            $quotation_item               = new QuotationItems();
            $quotation_item->quotation_id = $request->quotation_id;
            $quotation_item->product_id   = $request->product_id;
            $quotation_item->price_level  = $request->price_level;
            $quotation_item->price        = $request->price;
            $quotation_item->discount     = $request->discount;
            $quotation_item->sale_price   = $request->sale_price;
            $quotation_item->quantity     = $request->quantity;
            $quotation_item->save();

            echo 'SUCCESS';
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getProductItems($id)
    {
        $quotation_items = QuotationItems::where('quotation_id', $id)->get();

        $items_array = [];
        foreach ($quotation_items as $value) {
            array_push($items_array, [
                'id'           => $value->id,
                'product_code' => $value->product->code,
                'description'  => $value->product->description,
                'quantity'     => $value->quantity,
                'sale_price'   => $value->sale_price,
                'price'        => $value->price,
                'discount'     => $value->discount,
                'price_level'  => $value->price_level,
            ]);
        }

        echo json_encode($items_array);
    }

    public function update(Request $request)
    {
        try {
            $quotation = Quotation::find($request->quotation_id);

            $quotation->customer_id = $request->customer;
            $quotation->currency_id = $request->currency_id;
            $quotation->notes       = $request->quotation_notes;
            $quotation->is_draft    = false;
            $quotation->save();

            $request->session()->flash('success', 'Quotation saved!');
            return redirect()->route('quotation_list');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while saving quotation. Please try again!');
            return back()->withInput();
        }

    }

    public function printQuotation($id)
    {
        $company = Company::find(1);

        $quotation = Quotation::find($id);

        $product_items = $quotation->quotationItems;

        $product_items_array = [];

        $i        = 1;
        $qo_total = 0;

        foreach ($product_items as $item) {
            $amount = $item->quantity * $item->sale_price;
            $qo_total += $amount;

            $tmp = [
                'no'                 => $i,
                'product_code'       => $item->product->code,
                'product_desc'       => $item->product->description,
                'product_quantity'   => $item->quantity,
                'product_sale_price' => $item->sale_price,
                'product_amount'     => number_format($amount, 2),
            ];

            $i++;
            array_push($product_items_array, $tmp);
        }

        return view('quotation.print', [
            'quotation'     => $quotation,
            'product_items' => $product_items_array,
            'company'       => $company,
            'qo_total'      => number_format($qo_total, 2),
        ]);
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
            $quotation = Quotation::find($request->id);
            Quotation::destroy($request->id);

            QuotationItems::where('quotation_id', $request->id)->delete();

            $request->session()->flash('success', 'Quotation deleted!');
            return redirect()->route('quotation_list');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting quotation. Please try again!');
            return redirect()->route('quotation_list');
        }

    }
}
