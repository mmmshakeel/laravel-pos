<!-- resources/views/salesinvoice/list.blade.php -->
@extends('layouts.master')

@section('title', 'Sales Invoices')

@section('content')
<div class="block-header">
    <h2>Sales Invoices</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>Sales Invoices</h2>
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
                    <th data-column-id="id" data-type="numeric">Invoice Id #</th>
                    <th data-column-id="qo_date">Date</th>
                    <th data-column-id="customer">Customer</th>
                    <th data-column-id="quoted_branch">Invoiced Branch</th>
                    <th data-column-id="sales_rep">Sales Rep</th>
                    <th data-column-id="currency">Currency</th>
                    <th data-column-id="qo_amount">Amount</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesinvoices as $salesinvoice)
                    <tr>
                        <td>{{ $salesinvoice->id }}</td>
                        <td>{{ date('Y-m-d', strtotime($salesinvoice->created_at)) }}</td>
                        <td>{{ ($salesinvoice->customer) ? $salesinvoice->customer->title . ' ' . $salesinvoice->customer->first_name : '' }}</td>
                        <td>{{ ($salesinvoice->branch) ? $salesinvoice->branch->code : '' }}</td>
                        <td>{{ ($salesinvoice->salesRep) ? $salesinvoice->salesRep->code : '' }}</td>
                        <td>{{ ($salesinvoice->currency) ? $salesinvoice->currency->currency_code : '' }}</td>
                        <td>
                            <?php $amount = 0; ?>
                            @foreach($salesinvoice->salesinvoiceItems as $item)
                                <?php $amount = $amount + ($item->sale_price * $item->qty); ?>
                            @endforeach
                            {{ number_format($amount, 2) }}
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
                    return'<a href="quotation/print/' + row.id + '" title="Print Quotation" target="_blank"><button type="button" class="btn btn-icon command-print m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-print"></span></button></a>' +
                        '<a href="quotation/edit/' + row.id + '" title="Edit Quotation"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="quotation/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '" title="Delete Quotation"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        // activate the sidebar menu
        $(".sub-menu-quotation").addClass('active');
        $(".sub-menu-quotation").addClass('toggled');
        $(".sub-menu-quotation-list").addClass('active');
    });
</script>
@endsection
