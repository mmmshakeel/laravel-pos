<!-- resources/views/purchaseorder/polist.blade.php -->
@extends('layouts.master')

@section('title', 'Purchase Orders')

@section('content')
<div class="block-header">
    <h2>Purchase Orders</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>Purchase Orders</h2>
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
                    <th data-column-id="id" data-type="numeric">PO #</th>
                    <th data-column-id="po_date">Date</th>
                    <th data-column-id="supplier">Supplier</th>
                    <th data-column-id="ship_to_branch">Ship to Branch</th>
                    <th data-column-id="received_status">Received Status</th>
                    <th data-column-id="invoiced_status">Invoiced Status</th>
                    <th data-column-id="terms">Terms</th>
                    <th data-column-id="loc_sub_loc">Loc/Sub-Loc</th>
                    <th data-column-id="currency">Currency</th>
                    <th data-column-id="po_amount">Amount</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase_orders as $po)
                    <tr>
                        <td>{{ $po->id }}</td>
                        <td>{{ date('Y-m-d', strtotime($po->created_at)) }}</td>
                        <td>{{ ($po->supplier) ? $po->supplier->code : '' }}</td>
                        <td>{{ ($po->shipToBranch) ? $po->shipToBranch->code : '' }}</td>
                        <td>
                            @if ($po->is_received == 'f')
                                <span>Not Received</span>
                            @else
                                <span>Received</span>
                            @endif
                        </td>
                        <td>
                            @if ($po->is_invoiced == 'f')
                                <span>Not Invoiced</span>
                            @else
                                <span>Invoiced</span>
                            @endif
                        </td>
                        <td>{{ $po->term->description }}</td>
                        <td>{{ $po->location->code }}</td>
                        <td>{{ $po->currency->currency_code }}</td>
                        <td>
                            @foreach($po_amounts as $po_amount)
                                @if ($po->id == $po_amount['po_id'])
                                    {{ number_format($po_amount['po_amount'], 2) }}
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
                    return'<a href="purchase-orders/print/' + row.id + '" title="Print PO" target="_blank"><button type="button" class="btn btn-icon command-print m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-print"></span></button></a>' +
                        '<a href="purchase-orders/edit/' + row.id + '" title="Edit PO"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                        '<a href="purchase-orders/makeinvoice/' + row.id + '" title="Inovoice PO"><button type="button" class="btn btn-icon command-makeinvoice m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-upload"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="purchase-orders/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '" title="Delete PO"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        // activate the sidebar menu
        $(".sub-menu-purchase").addClass('active');
        $(".sub-menu-purchase").addClass('toggled');
        $(".sub-menu-purchase-order").addClass('active');
    });
</script>
@endsection
