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
        </div>
    </div>

    <div class="card">
        <div class="card-body card-padding">
            <div class="row">
                <p class="f-500 m-b-20 c-black">Product Price Details: </p>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Cost</label>
                        <p>{{ $product->cost }}</p>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Price Level 1</label>
                        <p>{{ $product->price_level1 }}</p>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Price Level 2</label>
                        <p>{{ $product->price_level2 }}</p>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Price Level 3</label>
                        <p>{{ $product->price_level3 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body card-padding">
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
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $(".sub-menu-inventory").addClass('active');
        $(".sub-menu-inventory").addClass('toggled');
    });
</script>
@endsection