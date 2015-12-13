<!-- resources/views/branch/addbranch.blade.php -->
@extends('layouts.master')

@section('title', 'Add Branch')

@section('content')
<div class="block-header">
    <h2>Add New Branch</h2>
</div>

<form method="POST" action="/branch/store">
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

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('fail') }}
                </div>
            @endif

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-city-alt m-r-5"></i> Branch Details</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Code</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="eg. BR001" name="code" value="{{ old('code') }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Description</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="description" value="{{ old('description') }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Address</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="address" value="{{ old('address') }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">City</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="city" value="{{ old('city') }}" />
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
                                        @if ($country->id == old('country'))
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
                                <input type="text" value="{{ old('contact_no') }}" class="form-control" name="contact_no">
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Contact Email</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="email" value="{{ old('contact_email') }}" class="form-control" name="contact_email">
                            </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="row pull-right">
                        <button class="btn bgm-teal m-r-10" type="submit">Save</button>
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
        $(".sub-menu-branches-add").addClass('active');
    });
</script>
@endsection