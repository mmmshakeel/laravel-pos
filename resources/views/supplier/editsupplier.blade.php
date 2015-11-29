<!-- resources/views/branch/editsupplier.blade.php -->
@extends('layouts.master')

@section('title', 'Edit Supplier')

@section('content')
<div class="block-header">
    <h2>Edit Supplier Details - {{ $supplier->code }}</h2>
</div>

<form method="POST" action="/supplier/update">
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
                    <h2><i class="zmdi zmdi-city-alt m-r-5"></i>Supplier Details</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Code</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="eg. SUP001" name="code" value="{{ $supplier->code }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Company Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="company_name" value="{{ $supplier->company_name }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Address</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="address" value="{{ $supplier->address }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">City</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="city" value="{{ $supplier->city }}" />
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
                                        @if ($country->id == $supplier->country)
                                            selected="selected"
                                        @endif
                                        >{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="profile-main">
        <div class="card-body card-padding">
            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-phone m-r-5"></i>Contact Details</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Title</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="contact_title">
                                    <option value="Mr" @if ($supplier->contact_title == 'Mr') selected="selected" @endif >Mr</option>
                                    <option value="Miss" @if ($supplier->contact_title == 'Miss') selected="selected" @endif>Miss</option>
                                    <option value="Mrs" @if ($supplier->contact_title == 'Mrs') selected="selected" @endif>Mrs</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">First Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="contact_first_name" value="{{ $supplier->contact_first_name }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Last Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="contact_last_name" value="{{ $supplier->contact_last_name }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Mobile</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="contact_mobile" value="{{ $supplier->contact_mobile }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Phone</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="phone" value="{{ $supplier->phone }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Email</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="email" class="form-control" placeholder="" name="email" value="{{ $supplier->email }}" />
                            </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="row pull-right">
                        <input type="hidden" name="id" value="{{ $supplier->id }}">
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
        $(".sub-menu-supplier").addClass('active');
        $(".sub-menu-supplier").addClass('toggled');
    });
</script>
@endsection