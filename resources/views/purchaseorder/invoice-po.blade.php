<!-- resources/views/purchase-order/invoice-po.blade.php -->
@extends('layouts.master')

@section('title', 'Invoice Purchase Order')

@section('content')
<div class="block-header">
    <h2>Invoice Purchase Order</h2>
</div>

<div class="card">
    <div class="card-header">
        <h2>Inovicing Purchase Order - #{{ $purchase_order->id }}</h2>
    </div>

    <div class="card-body card-padding">
        <div class="alert alert-danger hidden" role="alert">Failed to invoice purchase order. Please try again later.</div>
        <div class="row">
            <div class="col-sm-6">
                <p class="f-500 c-black m-b-20">Please wait...<p>
                <div class="progress progress-striped active">
                    <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                        <span class="sr-only">45% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// TODO: customer animation for progress bar

    $(document).ready(function() {
        $.get('/purchase-orders/doinvoice/{{ $purchase_order->id }}', function(data) {
            if (data != 'fail') {
                // redirect to the purchase invocei edit page
                window.location.replace("/purchase-invoice/edit/{{ $purchase_order->id }}");
            } else {
                $(".alert-danger").removeClass('hidden');
            }
        });
    });
</script>
@endsection