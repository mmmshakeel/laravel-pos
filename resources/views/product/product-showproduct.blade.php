<!-- resources/views/product/product-addproduct.blade.php -->
@extends('layouts.master')

@section('title', 'View Product')

@section('content')
<div class="block-header">
    <h2>Product - {{ $product->code }}</h2>
</div>

    <div class="card">

        <div class="card-body card-padding">

            <div class="row">
                <p class="f-500 m-b-20 c-black">Product Details: </p>
                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Code:</label>
                        <p>{{ $product->code }}</p>
                    </div>
                </div>

                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Description</label>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Branch</label>
                        <p>{{ $product->branch->code }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Category</label>
                        <p>{{ $product->category->name }}</p>
                    </div>
                </div>

                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Brand</label>
                        <p>{{ $product->brand->name }}</p>
                    </div>
                </div>

                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Model</label>
                        <p>{{ $product->model->name }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <p class="f-500 m-b-20 c-black">Product Other Details: </p>

                <div class="col-sm-4 m-b-20">
                    <div class="form-group fg-line">
                        <label>Inventory Type</label>
                        <p>{{ $product->product_type->type }}</p>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Product Status</label>
                        @if ($product->active_status == 'A')
                            <p>Active</p>
                        @elseif ($product->active_status == 'I')
                            <p>Inactive</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body card-padding">
            <div class="row">
                <div class="col-sm-3 m-b-20">
                    <h3>Total Stocks</h3>
                    <h1>{{ $inventory_stock_total }}</h1>
                </div>
            </div>

            <div class="row">
                <table class="data-table-command table table-striped table-vmiddle">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-visible="false">#</th>
                            <th data-column-id="batch_id">Batch Number</th>
                            <th data-column-id="barcode">Barcode</th>
                            <th data-column-id="expiry_date" data-order="desc">Expiry Date</th>
                            <th data-column-id="stock_count" data-type="numeric">Batch Count</th>
                            <th data-column-id="cost">Cost</th>
                            <th data-column-id="price">Price</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_item_details as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->product_batch->batch_number }}</td>
                                <td>{{ $item->barcode }}</td>
                                <td>{{ $item->expiry_date }}</td>
                                <td>{{ $item->item_count }}</td>
                                <td>{{ $item->cost }}</td>
                                <td>{{ $item->price1 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="updateProductBatchModal" tabindex="-1" role="dialog" aria-labelledby="updateProductBatchModalLabel">
    <form method="POST" action="/product/update-batch" id="updateProductBatchModalForm">
        {!! csrf_field() !!}
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                    <h4 class="modal-title">
                        Update Product Batch
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="save-product-batch-result"></div>
                    <div class="row">
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Batch Number<sup class="req-star">*</sup></label>
                                <input type="text" name="batch_number" class="form-control c-black f-500" value="" />
                            </div>
                        </div>
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Barcode</label>
                                <input type="text" name="barcode" class="form-control c-black f-500" value="" />
                            </div>
                        </div>
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Expiry Date</label>
                                <input type="text" name="expiry_date" class="form-control c-black f-500 date-picker" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Price 1<sup class="req-star">*</sup></label>
                                <input type="number" name="price1" class="form-control align-right c-black f-500" value="" />
                            </div>
                        </div>
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Price 2</label>
                                <input type="number" name="price2" class="form-control align-right c-black f-500" value="" />
                            </div>
                        </div>
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Price 3</label>
                                <input type="number" name="price3" class="form-control align-right c-black f-500" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 m-b-20">
                            <label>Cost</label>
                            <input type="text" name="unit_cost" class="form-control align-right c-black f-500" value="" disabled="disabled" />
                        </div>
                        <div class="col-sm-4 m-b-20">
                            <label>Batch Count</label>
                            <input type="text" name="batch_count" class="form-control align-right c-black f-500" value="" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updateBatch(this.form)">Update</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <input type="hidden" name="product_item_id" value="">
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".data-table-command").bootgrid({
            css: {
                icon: 'zmdi icon',
                iconColumns: 'zmdi-view-module',
                iconDown: 'zmdi-expand-more',
                iconRefresh: 'zmdi-refresh',
                iconUp: 'zmdi-expand-less'
            },
            formatters: {
                "commands": function(column, row) {
                    return '<a onclick="openUpdateBatchModal(' + row.id + ')"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>';
                }
            }
        });

        $(".sub-menu-inventory").addClass('active');
        $(".sub-menu-inventory").addClass('toggled');
    });

    function openUpdateBatchModal(id) {
        
        removeAjaxErrors();

        // get the product item details to prefil the form
        $.ajax({
            method: "GET",
            url: "/product/get-product-item-details/" + id,
            statusCode: {
                401: function() {
                    growlNotify('Batch not found!', 'The selected batch of product is not found', 'danger');
                }
            },
            success: function(data) {
                $('input[name="batch_number"]').val(data.batch_number);
                $('input[name="barcode"]').val(data.barcode);
                $('input[name="expiry_date"]').val(data.expiry_date);
                $('input[name="price1"]').val(data.price1);
                $('input[name="price2"]').val(data.price2);
                $('input[name="price3"]').val(data.price3);
                $('input[name="unit_cost"]').val(data.cost);
                $('input[name="batch_count"]').val(data.item_count);
                $('input[name="product_item_id"]').val(data.id);

                $("#updateProductBatchModal").modal();
            },
        });
    }

    function updateBatch(form) {

        removeAjaxErrors();

        $.ajax({
            method: "POST",
            url: "/product/update-batch",
            data: $(form).serialize(),
            success: function(data) {
                
                $("#updateProductBatchModal").modal('hide');
            },
            error: function(response) {
                var html = '<div class="alert alert-danger" role="alert">';
                html += '<ul>';
                

                var errors = response.responseJSON

                $(errors).each(function(index, error) {
                    // get the batch number errors
                    var batch_number_errors = error.batch_number;
                    var price_errors = error.price1;

                    if (batch_number_errors) {
                        for (var i = batch_number_errors.length - 1; i >= 0; i--) {
                            html += '<li>' + batch_number_errors[i] + '</li>';
                        }    
                    }
                    
                    if (price_errors) {
                        for (var i = price_errors.length - 1; i >= 0; i--) {
                            html += '<li>' + price_errors[i] + '</li>';
                        }
                    }

                });

                html += '</ul>';
                html += '</div>';
                $(".save-product-batch-result").html(html);
            }
        });
    }

    function removeAjaxErrors() {
        $(".save-product-batch-result").html('');
    }
</script>
@endsection
