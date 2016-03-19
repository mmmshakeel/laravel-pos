<!-- resources/views/purchaseorder/polist.blade.php -->
@extends('layouts.master')

@section('title', 'Purchase Invoices')

@section('content')
<div class="block-header">
    <h2>Purchase Invoices</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>Purchase Invoices</h2>
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
                    <th data-column-id="id" data-type="numeric">PI #</th>
                    <th data-column-id="po_date">Date</th>
                    <th data-column-id="supplier">Supplier</th>
                    <th data-column-id="account">Account</th>
                    <th data-column-id="ship_to_branch">Ship to Branch</th>
                    <th data-column-id="terms">Terms</th>
                    <th data-column-id="loc_sub_loc">Loc/Sub-Loc</th>
                    <th data-column-id="currency">Currency</th>
                    <th data-column-id="po_amount">Amount</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase_invoices as $pi)
                    <tr>
                        <td>{{ $pi->id }}</td>
                        <td>{{ date('Y-m-d', strtotime($pi->created_at)) }}</td>
                        <td>{{ ($pi->supplier) ? $pi->supplier->code : '' }}</td>
                        <td></td>
                        <td>{{ ($pi->shipToBranch) ? $pi->shipToBranch->code : '' }}</td>
                        <td>{{ ($pi->term) ? $pi->term->description : '' }}</td>
                        <td>{{ ($pi->location) ? $pi->location->code : '' }}</td>
                        <td>{{ ($pi->currency) ? $pi->currency->currency_code : '' }}</td>
                        <td>
                            @foreach($pi_amounts as $pi_amount)
                                @if ($pi->id == $pi_amount['pi_id'])
                                    {{ number_format($pi_amount['pi_amount'], 2) }}
                                @endif
                            @endforeach
                        </td>
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
                    return'<a href="purchase-invoice/print/' + row.id + '" title="Print PO"><button type="button" class="btn btn-icon command-print m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-print"></span></button></a>' +
                        '<a href="purchase-invoice/edit/' + row.id + '" title="Edit PO"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="#">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '" title="Delete PO"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        // activate the sidebar menu
        $(".sub-menu-purchase").addClass('active');
        $(".sub-menu-purchase").addClass('toggled');
        $(".sub-menu-purchase-invoice").addClass('active');
    });
</script>
@endsection
