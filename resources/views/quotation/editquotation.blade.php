<!-- resources/views/purchase-order/new-po.php -->
@extends('layouts.master')

@section('title', 'Sales Quotation')

@section('content')
<div class="block-header">
    <h2>Sales Quotation</h2>
</div>

<form name="purchase_invoice_form" method="POST" action="/quotation/update">
    {!! csrf_field() !!}
    <div class="card">
        @if($quotation->is_draft)
            <div class="draft-notice">
                Draft Quotation
            </div>
        @endif
        <div class="card-header">
            <h2>Sales Quotation - #{{ $draft_id }}</h2>
        </div>

        <div class="card-body card-padding">
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('fail') }}
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-sm-3 pull-right">
                    <div class="col-sm-6">
                        <p class="c-black f-500">Quotation Date: </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="c-black f-500">{{ date('d-m-Y', strtotime($quotation->created_at)) }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p class="f-500 m-b-20 c-black">Customer: <sup class="req-star">*</sup></p>
                    <select name="customer" class="selectpicker" data-live-search="true" onchange="updateCustomerDetails(this.value);">
                        <option value=""></option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                        @if ($customer->id == $quotation->customer_id)
                            selected="selected"
                        @endif
                        >{{ $customer->first_name }} {{ $customer->last_name }}</option>
                        @endforeach
                    </select>
                    <div class="col-sm-12 po-contact-details-box-bg">
                        <div id="QoCustomerDetails" class="po-contact-details-box">
                            @if($quotation->customer)
                                {{ $quotation->customer->title}} {{ $quotation->customer->first_name}} {{ $quotation->customer->last_name}}<br />
                                {{ $quotation->customer->address}}<br/>
                                {{ $quotation->customer->city}}<br/>
                                {{ $quotation->customer->country->country_name}}<br/><br/>
                                {{ $quotation->customer->mobile}}<br/>
                                {{ $quotation->customer->telphone}}<br/>
                                {{ $quotation->customer->email}}
                            @endif
                        </div>
                    </div>
                    <button type="button" class="btn bgm-teal waves-effect m-5" data-toggle="modal" data-target="#addCustomerModal">Add Customer</button>
                </div>
                <div class="col-sm-4">
                    <p class="f-500 m-b-20 c-black">Contact:</p>

                    <div class="col-sm-12 po-contact-details-box-bg m-t-30">
                        <div id="PoContactDetails" class="po-contact-details-box">
                            <div class="fg-line">
                                <textarea class="form-control" rows="6" name="supplier_contact"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                <p class="f-500 m-b-20 c-black">Quoted Branch:</p>

                    <div class="col-sm-12 po-contact-details-box-bg m-t-30">
                        <div id="PoContactDetails" class="po-contact-details-box">
                            {{ $quotation->branch->code }}<br />
                            {{ $quotation->branch->address }}<br />
                            {{ $quotation->branch->city }}<br />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 m-t-10 c-black">
                    <table class="table table-bordered purchase-order-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="align-center">Product Code</th>
                                <th class="align-center">Description</th>
                                <th class="align-right">Price</th>
                                <th class="align-right">Discount (%)</th>
                                <th class="align-right">Offered Price</th>
                                <th class="align-right">Qty</th>
                                <th class="align-right">Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="purchase-order-table-tbody">
                            <tr class="hidden load_product_items">
                                <td colspan="9"></td>
                            </tr>
                            <tr class="add-product">
                                <td colspan="9">
                                    <button type="button" class="btn bgm-blue waves-effect" data-toggle="modal" data-target="#addQuotationItemModal">Add Product</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row m-t-10">
                <div class="col-sm-4">
                    <div class="po-big-box m-5">
                        <p class="f-500 m-b-5 c-black">Sales Rep:</p>
                        <p class="f-500 m-b-20">{{ $quotation->salesRep->code }}</p>

                        <p class="m-b-5 c-black"><label>Currency</label></p>
                        <select class="selectpicker" name="currency_id" data-live-search="true">
                            @foreach ($currency_list as $currency)
                            <option value="{{ $currency->id }}"
                                @if ($currency->id == $quotation->currency_id)
                                    selected="selected"
                                @endif
                            >{{ $currency->currency_code }} - {{ $currency->currency_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="po-big-box m-5">
                        <p class="c-black f-500 m-b-20">Notes</p>

                        <div class="">
                            <div class="fg-line">
                                <textarea class="form-control" rows="5" placeholder="Internal notes for the quotation...." name="quotation_notes">{{ $quotation->notes }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="po-big-box m-5 align-right">
                        <p class="f-500 c-black po-total">Total</p>
                        <p class="f-500 c-black po-total">
                            <span class="currency_code">LKR</span>
                            <span id="totalQuotationCharge">0.00</span>
                        </p>
                    </div>

                    <button class="btn btn-lg bgm-teal btn-block waves-effect m-t-20">Update Quotation</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="quotation_id" id="quotationId" value="{{ $draft_id }}" />
</form>

@include('customer.addcustomer-modal')

@include('quotation.quotation-product-modal')

<script type="text/javascript">
    var totalQuotationCharge = 0;
    var qoRowcount = 0;

    $(document).ready(function() {
        $(".sub-menu-quotation").addClass('active');
        $(".sub-menu-quotation").addClass('toggled');
        $(".sub-menu-quotation-add").addClass('active');

        loadProductItems();
    });

    function updateCustomerDetails(customer_id) {
        if (!customer_id) {
            $("#QoCustomerDetails").html("");
            return;
        }

        $("#QoCustomerDetails").addClass("loader");

        $.getJSON("/customer/getcustomer/" + customer_id, function(data){
            $("#QoCustomerDetails").removeClass("loader");

            var html = data.title + " " + data.first_name + " " + data.last_name + "<br />" + data.address + "<br />";
            html+= data.city + "<br />" + data.country + "<br /><br />";
            html += data.mobile + "<br />" + data.telephone + "<br />" + data.email;
            $("#QoCustomerDetails").html(html);
        });
    }

    function updateBranchDetails(branch_id) {
        if (!branch_id) {
            $("#PoShipDetails").html("");
            return;
        }

        $("#PoShipDetails").addClass("loader");

        $.getJSON("/purchase-orders/getbranch/" + branch_id, function(data){
            $("#PoShipDetails").removeClass("loader");

            var html = data.code + "<br />" + data.description + "<br />" + data.address + ", " + data.city + "<br />";
            $("#PoShipDetails").html(html);
        });
    }

    function getProductDescription(product_id) {
        if (product_id) {
            $.get('/purchase-orders/get-product-description/' + product_id, function(data) {
                $("#product-field-description").text(data);
            });
        } else {
            $("#product-field-description").text('');
        }

    }

    function calculateAmount() {
        var ordered_value = parseInt($("#product-field-ordered").val());
        var eachcost_value = parseFloat($("#product-field-eachcost").val());

        if (!ordered_value) {
            ordered_value = 0;
        }

        if (!eachcost_value) {
            eachcost_value = 0;
        }

        var amount_value = ordered_value * eachcost_value;

        $("#product-field-amount").text(amount_value.toFixed(2));

        var temp_total = totalQuotationCharge + amount_value;
        $("#totalQuotationCharge").text(temp_total.toFixed(2));
    }

    function saveQuotationItem() {
        // validate
        if ($("#productId").val() == ''
            || $("#productPrice").val() == ''
            || $("#productQuantity").val() == ''
            || $("#productQuantity").val() == 0) {
            alert('Please fill the product order details');
            return;
        }

        var product_discount = 0;
        if ($("#productDiscount").val()) {
            product_discount = $("#productDiscount").val();
        }

        $.post('/quotation/save-quotation-product/', {
            quotation_id: $("#quotationId").val(),
            product_id: $("#productId").val(),
            price_level: $('input[name=product_price_level]:checked').data("pricelevel"),
            price: $("#productPrice").val(),
            discount: product_discount,
            sale_price: $("#productSalePrice").val(),
            quantity: $("#productQuantity").val()
        }, function(data) {
            if (data == 'SUCCESS') {
                loadProductItems();
                $("#addQuotationItemModal").modal('hide');
            } else {
                alert(data);
                return;
            }
        });
    }

    function loadProductItems() {
        qoRowcount = 0;
        totalQuotationCharge =0;

        var quotation_id = $("#quotationId").val();

        $(".loaded_product_items").remove();

        var html = '<tr class="product_items_loader">';
        html += '<td colspan="9" class="loader"></td>';
        html += '</tr>';

        $(".load_product_items").before(html);

        $.getJSON("/quotation/get-product-items/" + quotation_id, function(data){
            if (data.length != 0) {
                $.each(data, function(key, value) {
                    $(".product_items_loader").remove();
                    qoRowcount++;
                    var item_cost = value.quantity * value.sale_price;
                    totalQuotationCharge = totalQuotationCharge + item_cost;

                    var html = '<tr class="loaded_product_items">';
                    html += '<td>' + qoRowcount + '</td>';
                    html += '<td>' + value.product_code + '</td>';
                    html += '<td>' + value.description + '</td>';
                    html += '<td align="right" class="c-black f-500">' + value.price + '</td>';
                    html += '<td align="right" class="c-black f-500">' + value.discount + '</td>';
                    html += '<td align="right" class="c-black f-500">' + value.sale_price + '</td>';
                    html += '<td align="right" class="c-black f-500">' + value.quantity + '</td>';
                    html += '<td align="right" class="c-black f-500">' + item_cost.toFixed(2) + '</td>';
                    html += '<td width="2%" title="Remove Item" align="center" class="delete-action" onclick="deleteProductItem(\''+ value.id +'\')"><i class="zmdi zmdi-close-circle zmdi-hc-fw"></i></td>';
                    html += '</tr>';

                    $("#totalQuotationCharge").text(totalQuotationCharge.toFixed(2));

                    $(".load_product_items").before(html);
                });
            } else {
                $(".product_items_loader").remove();
            }
        });
    }

    function deleteProductItem(id) {
        $.post('/purchase-invoice/delete-pi-product/', {
            id: id
        }, function(data) {
            if (data == '1') {
                removeProductfield();
                loadProductItems();
            } else {
                alert('Error removing item.');
                return;
            }
        });
    }

</script>
@endsection
