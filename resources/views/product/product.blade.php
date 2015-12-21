<!-- resources/views/branch/branchlist.blade.php -->
@extends('layouts.master')

@section('title', 'Inventory - Find Product')

@section('content')
<div class="block-header">
    <h2>Find Products</h2>
</div>
<div class="card">


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

        <p class="f-500 m-b-20 c-black">Filter: </p>

        <div class="row">
            <form>
                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Code</label>
                        <input type="text" class="form-control input-mask" placeholder="eg: PR-001">
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Description</label>
                        <input type="text" class="form-control input-mask" placeholder="eg: printer">
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Cost</label>
                        <input type="text" class="form-control input-mask" placeholder="eg: 250.20">
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Rack #</label>
                        <input type="text" class="form-control input-mask" placeholder="">
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Category</label>
                        <select class="selectpicker" name="category" data-live-search="true">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Brand</label>
                        <select class="selectpicker" name="model" data-live-search="true">
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Model</label>
                        <select class="selectpicker" name="model" data-live-search="true">
                            @foreach ($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                    <button class="btn bgm-teal m-r-10 m-t-15 waves-effect" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <p class="f-500 m-b-20 c-black">List of Products: </p>

        <div class="row">
            <table class="data-table-command table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="code" data-order="desc">Code</th>
                        <th data-column-id="description">Description</th>
                        <th data-column-id="cost">Cost</th>
                        <th data-column-id="price_level1">Price Level1</th>
                        <th data-column-id="price_level2">Price Level2</th>
                        <th data-column-id="price_level3">Price Level3</th>
                        <th data-column-id="total_stock">Total Stock</th>
                        <th data-column-id="available_stock">Available Stock</th>
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->description }}</td>
                            <td align="right">{{ $product->cost }}</td>
                            <td align="right">{{ $product->price_level1 }}</td>
                            <td align="right">{{ $product->price_level2 }}</td>
                            <td align="right">{{ $product->price_level3 }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                            return '<a href="branch/edit/' + row.id + '"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                                '<form style="display: inline-block" method="POST" action="branch/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button></form>';
                        }
                    }
                });

                $(".sub-menu-inventory").addClass('active');
                $(".sub-menu-inventory").addClass('toggled');
                $(".sub-menu-find-product").addClass('active');
            });
        </script>
@endsection