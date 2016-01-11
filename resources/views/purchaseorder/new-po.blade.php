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
            <div class="col-sm-12 m-t-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Code</th>
                            <th>Description</th>
                            <th>Ordered</th>
                            <th>Each Cost</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="add-product">
                            <td colspan="6">
                                <button class="btn bgm-blue waves-effect">Add Product</button>
                            </td>
                        </tr>
                        <tr class="product-feilds">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="action-product hidden">
                            <td colspan="5"></td>
                            <td align="right">
                                <button class="btn bgm-green waves-effect">Add</button>
                                <button class="btn bgm-red waves-effect">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
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

    function addProduct() {

    }
</script>
@endsection