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
                        <th data-column-id="category">Category</th>
                        <th data-column-id="brand">Brand</th>
                        <th data-column-id="model">Model</th>
                        <th data-column-id="status">Status</th>
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
                            <td align="right">{{ $product->category->name }}</td>
                            <td align="right">{{ $product->brand->name }}</td>
                            <td align="right">{{ $product->model->name }}</td>
                            <td align="right">
                                @if ($product->active_status == 'A')
                                    <span class="label label-success">Active</span>
                                @elseif ($product->active_status == 'I')
                                    <span class="label label-default">Inactive</span>
                                @endif
                            </td>
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
                            return'<a href="product/show/' + row.id + '"><button title="View Product" type="button" class="btn btn-icon command-show m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-view-compact"></span></button></a>' +
                                '<a href="product/edit/' + row.id + '"><button title="Edit" type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                                '<form style="display: inline-block" method="POST" action="product/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button title="Delete" type="button" class="btn btn-icon command-delete" data-row-id="' + row.id + '" onclick="confirmDelete(this.form)"><span class="zmdi zmdi-delete"></span></button></form>';
                        }
                    }
                });

                $(".sub-menu-inventory").addClass('active');
                $(".sub-menu-inventory").addClass('toggled');
                $(".sub-menu-find-product").addClass('active');

            });

            function confirmDelete(form) {
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete!",
                    closeOnConfirm: true
                }, function(){
                    form.submit();
                });
            }
        </script>
@endsection