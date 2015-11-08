<!-- resources/views/auth/register.blade.php -->
@extends('layouts.master')
@section('title', 'Regsiter Staff')
@section('content')
<div class="block-header">
    <h2>Add New Staff</h2>
</div>
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}
    <div class="card" id="profile-main">
        <div class="card-body card-padding">
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
                                <input type="text" class="form-control" placeholder="eg. EP001" name="code" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Title</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="title">
                                    <option>Mr</option>
                                    <option>Miss</option>
                                    <option>Mrs</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">First Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="first_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Last Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="last_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Gender</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Birthday</dt>
                            <dd>
                            <div class="dtp-container dropdown fg-line">
                                <input type="text" class="form-control date-picker" name="date_of_birth" data-toggle="dropdown" placeholder="Click here..." aria-expanded="false">
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Joined Date</dt>
                            <dd>
                            <div class="dtp-container dropdown fg-line">
                                <input type="text" class="form-control date-picker" name="joined_date" data-toggle="dropdown" placeholder="Click here..." aria-expanded="false">
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
                                <input type="email" class="form-control" placeholder="eg. testemail@example.com" name="email" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Telephone</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="telephone" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Mobile</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="mobile" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Address</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="address" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">City</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="city" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Country</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="country" />
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
                                    <option>Mr</option>
                                    <option>Miss</option>
                                    <option>Mrs</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Relationship</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="contact_person_relation" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">First Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="scontact_person_first_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Last Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="contact_person_last_name" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Telephone</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="contact_person_contact_no" />
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>
<!-- <form method="POST" action="/auth/register">
                                                                {!! csrf_field() !!}
                                                                <div class="mdl-grid">
        <style>
                                                                                                                                            .demo-card-wide.mdl-card {
                                                                                                                                                width: 512px;
                                                                                                                                            }
                                                                                                                                            .demo-card-wide > .mdl-card__title {
                                                                                                                                            }
        </style>
        <div class="mdl-cell mdl-cell--12-col">
            <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Staff Details</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="code" name="code">
                        <label class="mdl-textfield__label" for="code">Code</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>
    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
    <div>
        Password
        <input type="password" name="password">
    </div>
    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form> -->
@endsection