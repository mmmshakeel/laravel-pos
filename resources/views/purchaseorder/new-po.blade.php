<!-- resources/views/purchase-order/new-po.php -->
@extends('layouts.master')

@section('title', 'Purchase Order')

@section('content')
<div class="block-header">
    <h2>Purchase Order</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>Prchase Order</h2>
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

        <div class="row">
            <div class="col-sm-2 pull-right">
                <div class="col-sm-2">
                    <p class="c-black f-500">Date: </p>
                </div>
                <div class="col-sm-2">
                    <p class="c-black f-500">{{ date('Y-m-d') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <p class="f-500 m-b-20 c-black">Vendor:</p>
                <select name="supplier" class="selectpicker" data-live-search="true" onchange="updateVendorDetails(this.value);">
                    <option value=""></option>
                    @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->code }}</option>
                    @endforeach
                </select>
                <div class="col-sm-12 po-contact-details-box-bg">
                    <div id="PoVendorDetails" class="po-contact-details-box"></div>
                </div>
            </div>
            <div class="col-sm-4">
                <p class="f-500 m-b-20 c-black">Contact:</p>
                <select class="selectpicker">
                    <option></option>
                </select>
                <div class="col-sm-12 po-contact-details-box-bg">
                    <div id="PoContactDetails" class="po-contact-details-box"></div>
                </div>
            </div>
            <div class="col-sm-4">
                <p class="f-500 m-b-20 c-black">Ship To:</p>
                <select name="branch" class="selectpicker" data-live-search="true" onchange="updateBranchDetails(this.value);">
                    <option value=""></option>
                    @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->code }}</option>
                    @endforeach
                </select>
                <div class="col-sm-12 po-contact-details-box-bg">
                    <div id="PoShipDetails" class="po-contact-details-box"></div>
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
                            <th class="align-right">Ordered</th>
                            <th class="align-right">Cost</th>
                            <th class="align-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="purchase-order-table-tbody">
                        <tr class="add-product">
                            <td colspan="6">
                                <button class="btn bgm-blue waves-effect" onclick="addProductField();">Add Product</button>
                            </td>
                        </tr>
                        <tr class="product-fields hidden">
                            <td>
                                <span id="product-field-count">#</span>
                            </td>
                            <td>
                                <select class="selectpicker" data-live-search="true" id="product-field-code" onchange="getProductDescription(this.value);">
                                    <option value=""></option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->code }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <span id="product-field-description"></span>
                            </td>
                            <td align="right">
                                <input type="number" id="product-field-ordered" class="form-control w150 align-right c-black f-500" onchange="calculateAmount();" />
                            </td>
                            <td align="right">
                                <input type="number" id="product-field-eachcost" class="form-control w150 align-right c-black f-500" onchange="calculateAmount();" />
                            </td>
                            <td align="right">
                                <span id="product-field-amount" class="c-black f-500"></span>
                            </td>
                        </tr>
                        <tr class="action-product hidden">
                            <td colspan="5"></td>
                            <td align="right">
                                <button class="btn bgm-green waves-effect" onclick="addProduct();">Add</button>
                                <button class="btn bgm-red waves-effect" onclick="cancelProduct();">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row m-t-10">
            <div class="col-sm-4">
                <div class="po-big-box m-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Purchase Rep</label></p>
                                <select class="selectpicker" name="po_staff">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Terms</label></p>
                                <select class="selectpicker" name="po_terms">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black">
                                    <label>Due Date</label>
                                    <label class="checkbox checkbox-inline c-black m-l-30 f-500">
                                        <input class="" type="checkbox" name="po_due_date_override" />
                                        <i class="input-helper"></i>
                                        Override
                                    </label>
                                </p>
                                <input class="form-control date-picker" type="text" name="po_due_date" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Ship Via</label></p>
                                <select class="selectpicker" name="po_ship_via">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Delivery Date</label></p>
                                <input class="form-control date-picker" type="text" name="po_delivery_date" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Expiry Date</label></p>
                                <input class="form-control date-picker" type="text" name="po_expiry_date" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Currency</label></p>
                                <select class="selectpicker" name="currency">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Tax Invoice Number</label></p>
                                <input class="form-control" name="po_tax_invoice_number"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Invoice Date</label></p>
                                <input class="form-control date-picker" type="text" name="po_tax_invoice_date"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="po-big-box m-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Vendor's Invoice Number</label></p>
                                <input class="form-control" name="po_vendor_invoice_number"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Date</label></p>
                                <input class="form-control date-picker" type="text" name="po_vendor_invoice_date"/>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Shipment Tracking Number</label></p>
                                <input class="form-control" name="po_shipment_tarcking_no"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Weight (kg)</label></p>
                                <input class="form-control" name="po_weight" type="number"/>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Reference</label></p>
                                <input class="form-control" name="po_reference" type="text"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <p class="m-b-5 c-black"><label>Loc/Sub-Loc</label></p>
                                <input class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="po-big-box m-5">
                    <table class="table table-bordered purchase-order-table">
                        <tr>
                            <td>Taxable</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Exempt</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var totalPoCharge = 0;
    var poRowcount = 0;

    $(document).ready(function() {
        $(".sub-menu-purchase").addClass('active');
        $(".sub-menu-purchase").addClass('toggled');
        $(".sub-menu-new-purchase-order").addClass('active');

    });

    function updateVendorDetails(vendor_id) {
        if (!vendor_id) {
            $("#PoVendorDetails").html("");
            return;
        }

        $("#PoVendorDetails").addClass("loader");

        $.getJSON("/purchase-orders/getsupplier/" + vendor_id, function(data){
            $("#PoVendorDetails").removeClass("loader");

            var html = data.code + "<br />" + data.company_name + "<br />" + data.address + ", " + data.city + "<br />";
            $("#PoVendorDetails").html(html);
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

    function addProductField() {
        $(".product-fields").removeClass('hidden');
        $(".action-product").removeClass('hidden');
        $(".add-product").addClass('hidden');

        poRowcount = parseInt(poRowcount) + 1;
        $("#product-field-count").text(poRowcount);
    }

    function removeProductfield() {
        $(".product-fields").addClass('hidden');
        $(".action-product").addClass('hidden');
        $(".add-product").removeClass('hidden');
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
    }

    function addProduct() {
        removeProductfield();



    }

    function cancelProduct() {
        removeProductfield();

        poRowcount = parseInt(poRowcount) - 1;
        $("#product-field-count").text(poRowcount);
    }
</script>
@endsection