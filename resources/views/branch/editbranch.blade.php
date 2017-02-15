<!-- resources/views/branch/editbranch.blade.php -->
@extends('layouts.master')

@section('title', 'Edit Branch')

@section('content')
<div class="block-header">
    <h2>Edit Branch</h2>
</div>

<form method="POST" action="/branch/update">
    {!! csrf_field() !!}
    <div class="card" id="profile-main">
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

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-city-alt m-r-5"></i> Edit Branch Details - {{ $branch->code }}</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Code</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="eg. BR001" name="code" value="{{ $branch->code }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Description</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="description" value="{{ $branch->description }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Address</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="address" value="{{ $branch->address }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">City</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="city" value="{{ $branch->city }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Country</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="country" data-live-search="true">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                        @if ($country->id == $branch->country_id)
                                            selected="selected"
                                        @endif
                                        >{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Contact Number</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ $branch->contact_no }}" class="form-control" name="contact_no">
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Contact Email</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="email" value="{{ $branch->contact_email }}" class="form-control" name="contact_email">
                            </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="row pull-right">
                        <input type="hidden" name="id" value="{{ $branch->id }}">
                        <button class="btn bgm-teal m-r-10" type="submit">Update</button>
                        <button class="btn bgm-gray" type="reset">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $(".sub-menu-company").addClass('active');
        $(".sub-menu-company").addClass('toggled');
    });
</script>
@endsection
