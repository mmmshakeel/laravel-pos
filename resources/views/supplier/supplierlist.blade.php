<!-- resources/views/branch/supplierlist.blade.php -->
@extends('layouts.master')

@section('title', 'Suppliers')

@section('content')
<div class="block-header">
    <h2>Branches</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>List of All Suppliers</h2>
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

        <table id="data-table-command" class="table table-striped table-vmiddle">
            <thead>
                <tr>
                    <th data-column-id="id" data-type="numeric">ID</th>
                    <th data-column-id="code" data-order="desc">Code</th>
                    <th data-column-id="company_name">Company Name</th>
                    <th data-column-id="address">Address</th>
                    <th data-column-id="city">City</th>
                    <th data-column-id="contact_name">Contact Name</th>
                    <th data-column-id="contact_mobile">Mobile</th>
                    <th data-column-id="phone">Phone</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->code }}</td>
                        <td>{{ $supplier->company_name }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->city }}</td>
                        <td>{{ $supplier->contact_title . " " . $supplier->contact_first_name . " " . $supplier->contact_last_name }}</td>
                        <td>{{ $supplier->contact_mobile }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->contact_email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#data-table-command").bootgrid({
            css: {
                icon: 'zmdi icon',
                iconColumns: 'zmdi-view-module',
                iconDown: 'zmdi-expand-more',
                iconRefresh: 'zmdi-refresh',
                iconUp: 'zmdi-expand-less'
            },
            formatters: {
                "commands": function(column, row) {
                    return '<a href="supplier/edit/' + row.id + '"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="supplier/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        // activate the sidebar menu
        $(".sub-menu-supplier").addClass('active');
        $(".sub-menu-supplier").addClass('toggled');
        $(".sub-menu-supplier-list").addClass('active');
    });
</script>
@endsection