<!-- resources/views/purchaseorder/po-print.blade.php -->
@extends('layouts.master')

@section('title', 'Print Quotation')

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
                    <div class="col-sm-4">Quotation #</div>
                    <div class="col-sm-8">{{ $quotation->id }}</div>
                </div>
                <div class="row c-black f-500">
                    <div class="col-sm-4">Date</div>
                    <div class="col-sm-8">{{ date('Y-m-d', strtotime($quotation->created_at)) }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 po-title">
                Quotation
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <p class="c-black f-500">Customer: </p>
                <p>
                    @if($quotation->customer)
                        {{ $quotation->customer->title}} {{ $quotation->customer->first_name}} {{ $quotation->customer->last_name}}<br />
                        {{ $quotation->customer->address}}<br/>
                        {{ $quotation->customer->city}}<br/>
                        {{ $quotation->customer->country->country_name}}<br/><br/>
                        {{ $quotation->customer->mobile}}<br/>
                        {{ $quotation->customer->telphone}}<br/>
                        {{ $quotation->customer->email}}
                    @endif
                </p>
            </div>
            <div class="col-sm-4">
                <p class="c-black f-500">Contact: </p>
                <p>
                    {{ nl2br($quotation->contact ) }}
                </p>
            </div>
            <div class="col-sm-4">
                <p class="c-black f-500">Quoted Branch: </p>
                <p>
                    {{ $quotation->branch->code }}<br />
                    {{ $quotation->branch->address }}<br />
                    {{ $quotation->branch->city }}<br />
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Sales Rep</th>
                            <th style="text-align:center;">Currency Code</th>
                            <th style="text-align:center;">Quotation Printed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">{{ $quotation->salesRep->code }}</td>
                            <td align="center">{{ $quotation->currency->currency_code }}</td>
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
                            <th class="align-center">#</th>
                            <th class="align-center">Product Code</th>
                            <th class="align-center">Description</th>
                            <th class="align-right">Qty</th>
                            <th class="align-right">Unit Price</th>
                            <th class="align-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_items as $item)
                        <tr>
                            <td align="center">{{ $item['no'] }}</td>
                            <td>{{ $item['product_code'] }}</td>
                            <td>{{ $item['product_desc'] }}</td>
                            <td align="right">{{ $item['product_quantity'] }}</td>
                            <td align="right">{{ $item['product_sale_price'] }}</td>
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
                    Total: {{ $qo_total }}
                </div>
            </div>
        </div>
        <div class="row">
            <small>This is a system generated Quotation, therefore signature is not required.</small>
        </div>
    </div>
</div>
@endsection
