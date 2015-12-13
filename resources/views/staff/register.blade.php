<!-- resources/views/staff/register.blade.php -->
@extends('layouts.master')

@section('title', 'Regsiter Staff')

@section('content')
<div class="block-header">
    <h2>Add New Staff</h2>
</div>
<form method="POST" action="/staff/store">
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
                    <h2><i class="zmdi zmdi-account m-r-5"></i> Basic Information</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Code</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="eg. EP001" name="code" value="{{ old('code') }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Title</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="title">
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">First Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="first_name" value="{{ old('first_name') }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Last Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="last_name" value="{{ old('last_name') }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Gender</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="gender">
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Birthday</dt>
                            <dd>
                            <div class="dtp-container dropdown fg-line">
                                <input type="text" value="{{ old('date_of_birth') }}" class="form-control date-picker" name="date_of_birth" data-toggle="dropdown" placeholder="Click here..." aria-expanded="false">
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Joined Date</dt>
                            <dd>
                            <div class="dtp-container dropdown fg-line">
                                <input type="text" value="{{ old('joined_date') }}" class="form-control date-picker" name="joined_date" data-toggle="dropdown" placeholder="Click here..." aria-expanded="false">
                            </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-phone m-r-5"></i> Contact Information</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Email</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="email" value="{{ old('email') }}" class="form-control" placeholder="eg. testemail@example.com" name="email" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Telephone</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('telephone') }}" class="form-control" placeholder="" name="telephone" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Mobile</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('mobile') }}" class="form-control" placeholder="" name="mobile" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Address</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('address') }}" class="form-control" placeholder="" name="address" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">City</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('city') }}" class="form-control" placeholder="" name="city" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Country</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('country') }}" class="form-control" placeholder="" name="country" />
                            </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-run m-r-5"></i> Emergency Contact Information</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Title</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="contact_person_title">
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Relationship</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('contact_person_relation') }}" class="form-control" placeholder="" name="contact_person_relation" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">First Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('scontact_person_first_name') }}" class="form-control" placeholder="" name="scontact_person_first_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Last Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('contact_person_last_name') }}" class="form-control" placeholder="" name="contact_person_last_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Telephone</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('contact_person_contact_no') }}" class="form-control" placeholder="" name="contact_person_contact_no" />
                            </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-key m-r-5"></i> System Access</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Branch</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="branch_id">
                                    <option value="1">Branch 1</option>
                                    <option value="2">Branch 2</option>
                                    <option value="3">Branch 3</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Username</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" value="{{ old('login_name') }}" class="form-control" placeholder="" name="login_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Password</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="password" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Confirm Password</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="password_confirmation" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Admin Access</dt>
                            <dd>
                            <div class="col-sm-4 m-b-20 m-t-10">
                                    <div class="toggle-switch">
                                        <input id="is_admin" name="is_admin" type="checkbox" value="1" hidden="hidden">
                                        <label for="is_admin" class="ts-helper"></label>
                                    </div>
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
        $(".sub-menu-staff-add").addClass('active');
    });
</script>
@endsection