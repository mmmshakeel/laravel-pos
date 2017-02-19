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
                    return '<a href="/product/model/edit/' + row.id + '"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>';
                }
            }
        });

        $(".sub-menu-inventory").addClass('active');
        $(".sub-menu-inventory").addClass('toggled');
    });
</script>
@endsection
