<!-- resources/views/product/product-models.blade.php -->
@extends('layouts.master')

@section('title', 'Product Models')

@section('content')
<div class="block-header">
    <h2>Inventory</h2>
</div>

<div class="card" id="profile-main">
    <div class="card-header">
        <h2>Product Model</h2>
    </div>

    <div class="card-body card-padding">

        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @elseif(Session::has('fail'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('fail') }}
            </div>
        @endif

        <form method="POST" action="/model/store">
        {!! csrf_field() !!}
            <p class="f-500 m-b-20 c-black">Add New Model: </p>
            <div class="row">
                <form>
                    <div class="col-sm-3 m-b-20">
                        <div class="form-group fg-line">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control input-mask" placeholder="Model name..." value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="col-sm-3 m-b-20">
                        <div class="form-group fg-line">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control input-mask" placeholder="Model description..." value="{{ old('description') }}">
                        </div>
                    </div>

                    <div class="col-sm-3 m-b-20">
                        <div class="form-group fg-line">
                            <label>Brand</label>
                            <select class="selectpicker" name="brand_id" data-live-search="true">
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                @if ($brand->id == old('brand_id'))
                                    selected="selected"
                                @endif
                                >{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 m-b-20">
                        <div class="form-group fg-line">
                        <button class="btn bgm-teal m-r-10 m-t-15 waves-effect" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </form>

        <p class="f-500 m-b-20 c-black">List of Models: </p>

        <div class="row">
            <table class="data-table-command table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="code" data-order="desc">Name</th>
                        <th data-column-id="description">Description</th>
                        <th data-column-id="brand">Brand</th>
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->description }}</td>
                            <td>{{ $model->brand->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
                    return '<a href="/product/model/edit/' + row.id + '"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="/model/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        $(".sub-menu-inventory").addClass('active');
        $(".sub-menu-inventory").addClass('toggled');
        $(".sub-menu-product-model").addClass('active');
    });
</script>
@endsection

