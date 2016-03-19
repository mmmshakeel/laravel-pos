<!-- resources/views/purchaseorder/po-print.blade.php -->
@extends('layouts.master')

@section('title', 'Print Purchase Invoice')

@section('sidebar')
@overwrite

@section('header')
@overwrite

@section('content')
<div class="card po-print-page">
    <div class="card-body card-padding">
        <div class="row">
            <div class="col-sm-8">
                <div class="po-company-logo">
                    <img src="/uploads/company-logo.png" />
                </div>
            </div>
            <div class="col-sm-4 po-detail m-t-30 p-t-10">
                <div class="row m-10">
                    <div class="company_name">{{ $company->name }}</div>
                    <div class="address-line">{{ $company->streetAddress }}, {{ $company->streetName }}</div>
                    <div class="address-line">{{ $company->city }}</div>
                    <div class="address-line">{{ $company->postcode }}</div>
                    <div class="address-line">{{ $company->country->country_name }}</div>
                    <div class="address-line">{{ $company->phone }}</div>
                </div>
                <div class="row c-black f-500">
                    <div class="col-sm-4">PI #</div>
                    <div class="col-sm-8">{{ $purchase_invoice->id }}</div>
                    @if ($purchase_invoice->purchaseOrder)
                        <div class="col-sm-4">PO #</div>
                        <div class="col-sm-8">{{ $purchase_invoice->purchaseOrder->id }}</div>
                    @endif
                </div>
                <div class="row c-black f-500">
                    <div class="col-sm-4">Date</div>
                    <div class="col-sm-8">{{ date('Y-m-d', strtotime($purchase_invoice->created_at)) }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 po-title">
                Purchase Invoice
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <p class="c-black f-500">Vendor: </p>
                <p>
                    {{ $purchase_invoice->supplier->code }} <br />
                    {{ $purchase_invoice->supplier->company_name }} <br />
                    {{ $purchase_invoice->supplier->address }} <br />
                    {{ $purchase_invoice->supplier->city }} <br />
                    {{ $purchase_invoice->supplier->country->country_name }} <br />
                </p>
            </div>
            <div class="col-sm-4">
                <p class="c-black f-500">Vendor Contact: </p>
                <p>
                    {{ nl2br($purchase_invoice->supplier_contact ) }}
                </p>
            </div>
            <div class="col-sm-4">
                <p class="c-black f-500">Ship To: </p>
                <p>
                    <p>
                    {{ $purchase_invoice->shipToBranch->code }} <br />
                    {{ $purchase_invoice->shipToBranch->description }} <br />
                    {{ $purchase_invoice->shipToBranch->address }} <br />
                    {{ $purchase_invoice->shipToBranch->city }} <br />
                    {{ $purchase_invoice->shipToBranch->country->country_name }} <br />
                </p>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Account</th>
                            <th style="text-align:center;">Terms</th>
                            <th style="text-align:center;">Purchase Rep</th>
                            <th style="text-align:center;">Currency Code</th>
                            <th style="text-align:center;">PI Printed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">10080</td>
                            <td align="center">{{ $purchase_invoice->term->description }}</td>
                            <td align="center">{{ $purchase_invoice->purchaseRep->code }}</td>
                            <td align="center">{{ $purchase_invoice->currency->currency_code }}</td>
                            <td align="center">{{ date('Y-m-d H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row product-items-wrap m-t-30">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center;">#</th>
                            <th style="text-align:center;">Item Code</th>
                            <th style="text-align:center;">Item Description</th>
                            <th style="text-align:center;">Ordered</th>
                            <th style="text-align:center;">Cost</th>
                            <th style="text-align:center;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_items as $item)
                        <tr>
                            <td align="center">{{ $item['no'] }}</td>
                            <td>{{ $item['product_code'] }}</td>
                            <td>{{ $item['product_desc'] }}</td>
                            <td align="right">{{ $item['product_count'] }}</td>
                            <td align="right">{{ $item['product_unit_cost'] }}</td>
                            <td align="right">{{ $item['product_amount'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
                <div class="po-total align-right c-black m-t-30">
                    Total: {{ $po_total }}
                </div>
            </div>
        </div>
        <div class="row">
            <small>This is a system generated PI, therefore signature not required.</small>
        </div>
    </div>
</div>
@endsection
