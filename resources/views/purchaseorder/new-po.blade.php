<!-- resources/views/purchase-order/new-po.php -->
@extends('layouts.master')

@section('title', 'Purchase Order')

@section('content')
<div class="block-header">
    <h2>Purchase Order</h2>
</div>

<form name="purchase_order_form" method="POST" action="/purchase-orders/update">
    {!! csrf_field() !!}
    <div class="card">
        <div class="card-header">
            <h2>Purchase Order - #{{ $draft_id }}</h2>
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
                <div class="col-sm-2 pull-right">
                    <div class="col-sm-2">
                        <p class="c-black f-500">Date: </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="c-black f-500">{{ date('d-m-Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p class="f-500 m-b-20 c-black">Vendor: <sup class="req-star">*</sup></p>
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

                    <div class="col-sm-12 po-contact-details-box-bg m-t-30">
                        <div id="PoContactDetails" class="po-contact-details-box">
                            <div class="fg-line">
                                <textarea class="form-control" rows="6" name="supplier_contact"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <p class="f-500 m-b-20 c-black">Ship To: <sup class="req-star">*</sup></p>
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="purchase-order-table-tbody">
                            <tr class="hidden load_product_items">
                                <td colspan="6"></td>
                            </tr>
                            <tr class="add-product">
                                <td colspan="7">
                                    <button type="button" class="btn bgm-blue waves-effect" onclick="addProductField();">Add Product</button>
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
                                    <button class="btn bgm-green waves-effect" type="button" onclick="addProduct();">Add</button>
                                    <button class="btn bgm-red waves-effect" type="button" onclick="cancelProduct();">Cancel</button>
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
                                    <input type="text" name="purchase_rep" value="{{ $user->staff->code }}" class="form-control" disabled="disabled" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group fg-line">
                                    <p class="m-b-5 c-black"><label>Terms <sup class="req-star">*</sup></label></p>
                                    <select class="selectpicker" name="po_terms" id="poTerm" onchange="termChange();">
                                        <option></option>
                                        @foreach ($terms as $term)
                                        <option value="{{ $term->id }}" data-days="{{ $term->days }}">{{ $term->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group fg-line">
                                    <p class="m-b-5 c-black">
                                        <label>Due Date</label>
                                    </p>
                                    <input class="form-control date-picker" type="text" name="po_due_date" id="poDueDate" value="{{ date('d-m-Y') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group fg-line">
                                    <p class="m-b-5 c-black"><label>Ship Via</label></p>
                                    <select class="selectpicker" name="po_ship_via">
                                        <option></option>
                                        @foreach ($shipping_services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
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
                                    <select class="selectpicker" name="currency" data-live-search="true">
                                        <option></option>
                                        @foreach ($currency_list as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->currency_code }} - {{ $currency->currency_name }}</option>
                                        @endforeach
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
                                    <input class="form-control" name="po_supplier_invoice_number"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group fg-line">
                                    <p class="m-b-5 c-black"><label>Date</label></p>
                                    <input class="form-control date-picker" type="text" name="po_supplier_invoice_date"/>
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
                                    <input class="form-control" value="{{ $user->branch->code }}" disabled="disabled"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="po-big-box m-5 align-right">
                        <p class="f-500 c-black po-total">Total</p>
                        <p class="f-500 c-black po-total">
                            <span class="currency_code">LKR</span>
                            <span id="totalPoCharge">0.00</span>
                        </p>
                    </div>

                    <button class="btn btn-lg bgm-teal btn-block waves-effect m-t-20">Save Purchase Order</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="purchase_order_id" id="purchaseOrderId" value="{{ $draft_id }}" />
</form>

<script type="text/javascript">
    var totalPoCharge = 0;
    var poRowcount = 0;

    $(document).ready(function() {
        $(".sub-menu-purchase").addClass('active');
        $(".sub-menu-purchase").addClass('toggled');
        $(".sub-menu-new-purchase-order").addClass('active');

        loadProductItems();
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
        $("#product-field-code").val('');
        $("#product-field-description").val('');
        $("#product-field-ordered").val('');
        $("#product-field-eachcost").val('');

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

        var temp_total = totalPoCharge + amount_value;
        $("#totalPoCharge").text(temp_total.toFixed(2));
    }

    function addProduct() {
        // validate
        if ($("#product-field-code").val() == ''
            || $("#product-field-ordered").val() == ''
            || $("#product-field-eachcost").val() == '') {
            alert('Please fill the product order details');
            return;
        }

        $.post('/purchase-orders/save-po-product/', {
            product_field_code: $("#product-field-code").val(),
            product_field_ordered: $("#product-field-ordered").val(),
            product_field_eachcost: $("#product-field-eachcost").val(),
            po_id: $("#purchaseOrderId").val()
        }, function(data) {
            if (data == '1') {
                removeProductfield();
                loadProductItems();
            } else {
                alert('Error saving.');
                return;
            }
        });
    }

    function cancelProduct() {
        removeProductfield();

        poRowcount = parseInt(poRowcount) - 1;
        $("#product-field-count").text(poRowcount);
    }

    function termChange(){
        var term = $("#poTerm option:selected");
        var days = term.data('days');

        $.get('/purchase-orders/get-term-due-date/' + days, function(data) {
            $("#poDueDate").val(data);
        });
    }


    function loadProductItems() {
        poRowcount = 0;
        totalPoCharge =0;

        var po_id = $("#purchaseOrderId").val();

        $(".loaded_product_items").remove();

        var html = '<tr class="product_items_loader">';
        html += '<td colspan="7" class="loader"></td>';
        html += '</tr>';

        $(".load_product_items").before(html);

        $.getJSON("/purchase-orders/get-product-items/" + po_id, function(data){
            if (data.length != 0) {
                $.each(data, function(key, value) {
                    $(".product_items_loader").remove();
                    poRowcount++;
                    var item_cost = value.item_count * value.unit_cost;
                    totalPoCharge = totalPoCharge + item_cost;

                    var html = '<tr class="loaded_product_items">';
                    html += '<td>' + poRowcount + '</td>';
                    html += '<td>' + value.product_code + '</td>';
                    html += '<td>' + value.product_description + '</td>';
                    html += '<td align="right" class="c-black f-500">' + value.item_count + '</td>';
                    html += '<td align="right" class="c-black f-500">' + value.unit_cost + '</td>';
                    html += '<td align="right" class="c-black f-500">' + item_cost.toFixed(2) + '</td>';
                    html += '<td width="2%" title="Remove Item" align="center" class="delete-action" onclick="deleteProductItem(\''+ value.product_item_id +'\')"><i class="zmdi zmdi-close-circle zmdi-hc-fw"></i></td>';
                    html += '</tr>';

                    $("#totalPoCharge").text(totalPoCharge.toFixed(2));

                    $(".load_product_items").before(html);
                });
            } else {
                $(".product_items_loader").remove();
            }
        });
    }

    function deleteProductItem(id) {
        $.post('/purchase-orders/delete-po-product/', {
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
    window.onbeforeunload = function() {
        return "confirm reload";
    }
</script>
@endsection