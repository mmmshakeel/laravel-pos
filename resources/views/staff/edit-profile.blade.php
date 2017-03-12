<!-- resources/views/staff/register.blade.php -->
@extends('layouts.master')

@section('title', 'Edit Staff')

@section('content')
<div class="block-header">
    <h2>Edit Staff</h2>
</div>
<form method="POST" action="/staff/update">
    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                <li>Please fill the required fields</li>
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-xs-6">
            <div class="card">
                <div class="card-header">
                    <h2>Basic Information</h2>
                </div>

                <div class="card-body card-padding">
                    <div class="row">

                        <div class="col-xs-4">
                            <div class="fg-line form-group">
                                <label>Title</label>
                                <select class="selectpicker" name="title">
                                    <option value="Mr" @if ($staff->title == 'Mr') 'selected="selected"' @endif>Mr</option>
                                    <option value="Miss" @if ($staff->title == 'Miss') 'selected="selected"' @endif>Miss</option>
                                    <option value="Mrs" @if ($staff->title == 'Mrs') 'selected="selected"' @endif>Mrs</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('first_name')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('first_name')) class="c-red" @endif>First Name <sup class="req-star">*</sup></label>
                                    <input type="text" class="form-control" placeholder="" name="first_name" value="{{ $staff->first_name ? $staff->first_name : old('first_name') }}" />
                                </div>
                                @if ($errors->has('first_name'))
                                    <small class="help-block">{{ $errors->first('first_name') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="fg-line form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="" name="last_name" value="{{ $staff->last_name ? $staff->last_name : old('last_name') }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xs-6">
                            <div class="form-group @if ($errors->has('code')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('code')) class="c-red" @endif>Employee Code <sup class="req-star">*</sup></label>
                                    <input type="text" class="form-control" placeholder="eg. EP001" name="code" value="{{ $staff->code ? $staff->code : old('code') }}" />
                                </div>
                                @if ($errors->has('code'))
                                    <small class="help-block">{{ $errors->first('code') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="fg-line form-group">
                                <label>Gender</label>
                                <select class="selectpicker" name="gender">
                                    <option value="M" @if ($staff->title == 'M') 'selected="selected"' @endif>Male</option>
                                    <option value="F" @if ($staff->title == 'F') 'selected="selected"' @endif>Female</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-6">
                            <div class="fg-line form-group">
                                <label>Birthday</label>
                                <input type="text" value="{{ $staff->date_of_birth ? date('d-m-Y', strtotime($staff->date_of_birth)) : old('date_of_birth') }}" class="form-control date-picker" name="date_of_birth" data-toggle="dropdown" placeholder="Click here..." aria-expanded="false">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group @if ($errors->has('joined_date')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('joined_date')) class="c-red" @endif>Joined Date</label>
                                    <input type="text" value="{{ $staff->joined_date ? date('d-m-Y', strtotime($staff->joined_date)) : old('joined_date') }}" class="form-control date-picker" name="joined_date" data-toggle="dropdown" placeholder="Click here..." aria-expanded="false">
                                </div>
                                @if ($errors->has('joined_date'))
                                    <small class="help-block">{{ $errors->first('joined_date') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="card">
                <div class="card-header">
                    <h2>Contact Information</h2>
                </div>

                <div class="card-body card-padding">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('email')) class="c-red" @endif>Email <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->email ? $staff->email : old('email') }}" class="form-control" placeholder="eg. testemail@example.com" name="email" />
                                </div>
                                @if ($errors->has('email'))
                                    <small class="help-block">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="fg-line form-group">
                                <label>Telephone</label>
                                <input type="text" value="{{ $staff->telephone ? $staff->telephone : old('telephone') }}" class="form-control" placeholder="" name="telephone" />
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('mobile')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('mobile')) class="c-red" @endif>Mobile <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->mobile ? $staff->mobile : old('mobile') }}" class="form-control" placeholder="" name="mobile" />
                                </div>
                                @if ($errors->has('mobile'))
                                    <small class="help-block">{{ $errors->first('mobile') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xs-12">
                            <div class="form-group @if ($errors->has('address')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('address')) class="c-red" @endif>Address <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->address ? $staff->address : old('address') }}" class="form-control" placeholder="" name="address" />
                                </div>
                                @if ($errors->has('address'))
                                    <small class="help-block">{{ $errors->first('address') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-6">
                            <div class="form-group @if ($errors->has('city')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('city')) class="c-red" @endif>City <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->city ? $staff->city : old('city') }}" class="form-control" placeholder="" name="city" />
                                </div>
                                @if ($errors->has('city'))
                                    <small class="help-block">{{ $errors->first('city') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="fg-line form-group">
                                <label>Country</label>
                                <select class="selectpicker" name="country" data-live-search="true">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                        @if ($country->id == $staff->country_id)
                                            selected="selected"
                                        @elseif ($country->id == old('country'))
                                            selected="selected"
                                        @endif
                                        >{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-6">
            <div class="card">
                <div class="card-header">
                    <h2>Emergency Contact Information</h2>
                </div>

                <div class="card-body card-padding">
                    <div class="row">

                        <div class="col-xs-4">
                            <div class="fg-line form-group">
                                <label>Title</label>
                                <select class="selectpicker" name="contact_person_title">
                                    <option value="Mr" @if ($staff->contact_person_title == 'Mr') 'selected="selected"' @endif>Mr</option>
                                    <option value="Miss" @if ($staff->contact_person_title == 'Miss') 'selected="selected"' @endif>Miss</option>
                                    <option value="Mrs" @if ($staff->contact_person_title == 'Mrs') 'selected="selected"' @endif>Mrs</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('contact_person_first_name')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('contact_person_first_name')) class="c-red" @endif>First Name <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->contact_person_first_name ? $staff->contact_person_first_name : old('contact_person_first_name') }}" class="form-control" placeholder="" name="contact_person_first_name" />
                                </div>
                                @if ($errors->has('contact_person_first_name'))
                                    <small class="help-block">{{ $errors->first('contact_person_first_name') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="fg-line form-group">
                                <label>Last Name</label>
                                <input type="text" value="{{ $staff->contact_person_last_name ? $staff->contact_person_last_name : old('contact_person_last_name') }}" class="form-control" placeholder="" name="contact_person_last_name" />
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-xs-6">
                            <div class="form-group @if ($errors->has('contact_person_relation')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('contact_person_relation')) class="c-red" @endif>Relationship <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->contact_person_relation ? $staff->contact_person_relation : old('contact_person_relation') }}" class="form-control" placeholder="" name="contact_person_relation" />
                                </div>
                                @if ($errors->has('contact_person_relation'))
                                    <small class="help-block">{{ $errors->first('contact_person_relation') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group @if ($errors->has('contact_person_contact_no')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('contact_person_contact_no')) class="c-red" @endif>Telephone <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->contact_person_contact_no ? $staff->contact_person_contact_no : old('contact_person_contact_no') }}" class="form-control" placeholder="" name="contact_person_contact_no" />
                                </div>
                                @if ($errors->has('contact_person_contact_no'))
                                    <small class="help-block">{{ $errors->first('contact_person_contact_no') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="card">
                <div class="card-header">
                    <h2>System Access</h2>
                </div>

                <div class="card-body card-padding">
                    <div class="row">

                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('login_name')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('login_name')) class="c-red" @endif>Username <sup class="req-star">*</sup></label>
                                    <input type="text" value="{{ $staff->user->login_name ? $staff->user->login_name : old('login_name') }}" class="form-control" placeholder="" name="login_name" />
                                </div>
                                @if ($errors->has('login_name'))
                                    <small class="help-block">{{ $errors->first('login_name') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('password')) class="c-red" @endif>Password <sup class="req-star">*</sup></label>
                                    <input type="text" class="form-control" placeholder="" name="password" />
                                </div>
                                @if ($errors->has('password'))
                                    <small class="help-block">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('password_confirmation')) class="c-red" @endif>Confirm Password <sup class="req-star">*</sup></label>
                                    <input type="text" class="form-control" placeholder="" name="password_confirmation" />
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <small class="help-block">{{ $errors->first('password_confirmation') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-3">
                            <div class="fg-line form-group">
                                <label>Admin Access</label> <br />

                                <label class="radio radio-inline m-r-20">
                                    <input name="is_admin" value="1" type="radio" @if ($staff->user->is_admin == 1) checked="checked" @endif>
                                    <i class="input-helper"></i>
                                    Yes
                                </label>

                                <label class="radio radio-inline m-r-20">
                                    <input name="is_admin" value="0" type="radio" @if ($staff->user->is_admin == 0) checked="checked" @endif>
                                    <i class="input-helper"></i>
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="form-group @if ($errors->has('branch_id')) has-error @endif">
                                <div class="fg-line">
                                    <label @if ($errors->has('branch_id')) class="c-red" @endif>Branch</label>
                                    <select name="branch_id" class="selectpicker" data-live-search="true">
                                        <option value=""></option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                            @if ($branch->id == $staff->user->branch_id)
                                                selected="selected"
                                            @elseif ($branch->id == old('branch_id'))
                                                selected="selected"
                                            @endif >{{ $branch->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('branch_id'))
                                    <small class="help-block">{{ $errors->first('branch_id') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="col-xs-6">
                                <button class="btn btn-block bgm-teal m-r-10 m-t-20" type="submit">Save</button>
                            </div>
                            <div class="col-xs-6">
                                <button class="btn btn-block bgm-gray m-t-20" type="reset">Reset</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $staff->id }}">
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $(".sub-menu-company").addClass('active');
        $(".sub-menu-company").addClass('toggled');
        $(".sub-menu-staff-add").addClass('active');
    });
</script>
@endsection