<!-- resources/views/quotaiton/list.blade.php -->
@extends('layouts.master')

@section('title', 'Quotations')

@section('content')
<div class="block-header">
    <h2>Quotations</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>Quotations</h2>
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
                    <th data-column-id="id" data-type="numeric">Quotation Id #</th>
                    <th data-column-id="qo_date">Date</th>
                    <th data-column-id="customer">Customer</th>
                    <th data-column-id="quoted_branch">Quoted Branch</th>
                    <th data-column-id="sales_rep">Sales Rep</th>
                    <th data-column-id="currency">Currency</th>
                    <th data-column-id="qo_amount">Amount</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotations as $quotation)
                    <tr>
                        <td>{{ $quotation->id }}</td>
                        <td>{{ date('Y-m-d', strtotime($quotation->created_at)) }}</td>
                        <td>{{ ($quotation->customer) ? $quotation->customer->title . ' ' . $quotation->customer->first_name : '' }}</td>
                        <td>{{ ($quotation->branch) ? $quotation->branch->code : '' }}</td>
                        <td>{{ ($quotation->salesRep) ? $quotation->salesRep->code : '' }}</td>
                        <td>{{ ($quotation->currency) ? $quotation->currency->currency_code : '' }}</td>
                        <td>
                            <?php $amount = 0; ?>
                            @foreach($quotation->quotationItems as $item)
                                <?php $amount = $amount + ($item->sale_price * $item->quantity); ?>
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
