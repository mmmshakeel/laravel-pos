<!-- resources/views/quotaiton/list.blade.php -->
@extends('layouts.master')

@section('title', 'Staff List')

@section('content')
<div class="block-header">
    <h2>Staff List</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>Staff List</h2>
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
                    <th data-column-id="id" data-type="numeric">Staff Id #</th>
                    <th data-column-id="code">Code</th>
                    <th data-column-id="name">Staff Name</th>
                    <th data-column-id="joined_date">Joined Date</th>
                    <th data-column-id="mobile">Mobile</th>
                    <th data-column-id="email">Email</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                    <tr>
                        <td>{{ $staff->id }}</td>
                        <td>{{ $staff->code }}</td>
                        <td>{{ $staff->title }} {{ $staff->first_name }} {{ $staff->last_name }}</td>
                        <td>{{ date('d/m/Y', strtotime($staff->joined_date)) }}</td>
                        <td>{{ $staff->mobile }}</td>
                        <td>{{ $staff->email }}</td>
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
                    return'<a href="/staff/show/' + row.id + '" title="Show Staff"><button type="button" class="btn btn-icon command-show m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-view-compact"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="/staff/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="button" onclick="confirmDelete(this.form)" class="btn btn-icon command-delete" data-row-id="' + row.id + '" title="Delete Staff"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        // activate the sidebar menu
        $(".sub-menu-company").addClass('active').addClass('toggled');
        $(".sub-menu-staff-list").addClass('active');
    });

    function confirmDelete(form) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover deleted information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
            closeOnConfirm: false
        },
        function(isConfirm){
            if (isConfirm) {
                form.submit();
            }
        });
    }
</script>
@endsection
