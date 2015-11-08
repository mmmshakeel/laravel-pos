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
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Branch</dt>
                            <dd>
                            <div class="fg-line">
                                <select class="selectpicker" name="branch_id">
                                    <option>Branch 1</option>
                                    <option>Branch 2</option>
                                    <option>Branch 3</option>
                                </select>
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Username</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="login_name" />
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
                                <input type="text" class="form-control" placeholder="" name="confirm_password" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Admin Access</dt>
                            <dd>
                            <div class="col-sm-4 m-b-20 m-t-10">
                                    <div class="toggle-switch">
                                        <input id="ts1" type="checkbox" hidden="hidden">
                                        <label for="ts1" class="ts-helper"></label>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="row">
                        <button class="btn bgm-teal" type="submit">Save</button>
                        <button class="btn bgm-gray" type="reset">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection