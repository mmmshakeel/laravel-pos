<!-- resources/views/branch/branchlist.blade.php -->
@extends('layouts.master')

@section('title', 'Branches')

@section('content')
<div class="block-header">
    <h2>Branches</h2>
</div>
<div class="card">
    <div class="card-header">
        <h2>List of All Branches</h2>
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
                    <th data-column-id="description">Description</th>
                    <th data-column-id="address">Address</th>
                    <th data-column-id="city">City</th>
                    <th data-column-id="contact_no">Contact Number</th>
                    <th data-column-id="contact_email">Contact Email</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branch->id }}</td>
                        <td>{{ $branch->code }}</td>
                        <td>{{ $branch->description }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>{{ $branch->city }}</td>
                        <td>{{ $branch->contact_no }}</td>
                        <td>{{ $branch->contact_email }}</td>
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
                    return '<a href="branch/edit/' + row.id + '"><button type="button" class="btn btn-icon command-edit m-r-5" data-row-id="' + row.id + '"><span class="zmdi zmdi-edit"></span></button></a>' +
                        '<form style="display: inline-block" method="POST" action="branch/destroy">{!! csrf_field() !!}{{ method_field("DELETE") }}<input type="hidden" name="id" value="' + row.id + '"><button type="submit" class="btn btn-icon command-delete" data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button></form>';
                }
            }
        });

        // activate the sidebar menu
        $(".sub-menu-branches").addClass('active');
        $(".sub-menu-branches").addClass('toggled');
        $(".sub-menu-branches-list").addClass('active');
    });

    function deleteBranch(id) {
        $.post("/branch/destroy", {
            id: id
        },
        function(data) {
            console.log(data);
        });
    }
</script>
@endsection