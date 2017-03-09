<!-- resources/views/notification/notification.blade.php -->
@extends('layouts.master')

@section('title', 'Notifications')

@section('content')
<div class="block-header">
    <h2>Notifications</h2>
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

        <div class="row">
            <table class="data-table-command table table-striped table-vmiddle">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric" data-visible="false">ID</th>
                        <th data-column-id="date" data-order="desc">Date</th>
                        <th data-column-id="notification">Notification</th>
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications2 as $notification)
                        <tr>
                            <td>{{ $notification->id }}</td>
                            <td>{{ $notification->created_at }}</td>
                            <td>{{ $notification->data['title'] }}</td>
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
                    return '<button></button>';
                }
            }
        });
    });
</script>
@endsection