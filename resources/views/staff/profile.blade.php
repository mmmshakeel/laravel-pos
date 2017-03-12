<!-- resources/views/staff/profile.blade.php -->

@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="block-header">
    <h2>{{ $staff->first_name }} {{ $staff->last_name }}<small>Employee #{{ $staff->code }}</small></h2>
</div>

<div class="card" id="profile-main">
    <div class="pm-overview c-overflow">
        <div class="pmo-pic">
            <div class="p-relative">
                <a href="">
                <img class="img-responsive" src="/img/profile-pics/profile-pic-2.jpg" alt="">
                </a>

                <div class="dropdown pmop-message">
                    <a data-toggle="dropdown" href="" class="btn bgm-white btn-float z-depth-1">
                    <i class="zmdi zmdi-comment-text-alt"></i>
                    </a>

                    <div class="dropdown-menu">
                        <textarea placeholder="Write something..."></textarea>

                        <button class="btn bgm-green btn-icon"><i class="zmdi zmdi-mail-send"></i></button>
                    </div>
                </div>

                <a href="" class="pmop-edit">
                <i class="zmdi zmdi-camera"></i> <span class="hidden-xs">Update Profile Picture</span>
                </a>
            </div>


            <div class="pmo-stat">
                <h2 class="m-0 c-white">{{ $staff->first_name }} {{ $staff->last_name }}</h2>
                {{ $staff->code }}
            </div>

            <div class="pmo-block pmo-contact hidden-xs">
            <h2>{{ $company->name}} <br />
                <small>Branch: {{ $staff->user->branch->description }}</small>
            </h2>

            <ul>
                <li><i class="zmdi zmdi-phone"></i> {{ $company->phone }}</li>
                <li>
                    <i class="zmdi zmdi-pin"></i>
                    <address class="m-b-0">
                    {{ $company->streetName }}, <br/>
                    {{ $company->streetAddress }}, <br/>
                    {{ $company->city }}, <br/>
                    {{ $company->postcode }}, <br/>
                    {{ $company->country->country_name }}
                    </address>
                </li>
            </ul>

            <div class="profile-action-bar m-t-20">
                <div class="col-xs-6">
                    <a href="/staff/edit/{{ $staff->id }}"><button class="btn btn-primary btn-lg btn-block bgm-teal waves-effect"><i class="zmdi zmdi-edit"></i></button></a>
                </div>
                <div class="col-xs-6">
                    <form method="POST" id="deleteStaffForm" action="/staff/destroy">
                        {!! csrf_field() !!}
                        {{ method_field("DELETE") }}
                        <input type="hidden" name="id" value="{{ $staff->id }}">
                        <button type="button" class="btn btn-danger btn-lg btn-block waves-effect" onclick="deleteStaff()"><i class="zmdi zmdi-delete"></i></button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="pm-body clearfix">


        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-account m-r-5"></i> Basic Information</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view">
                    <dl class="dl-horizontal">
                        <dt>Full Name</dt>
                        <dd>{{ $staff->title }} {{ $staff->first_name }} {{ $staff->last_name }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Gender</dt>
                        <dd>
                            @if ($staff->gender == 'M')
                                Male
                            @else
                                Female
                            @endif
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Birthday</dt>
                        <dd>
                            @if ($staff->date_of_birth && $staff->date_of_birth != '0000-00-00')
                                {{ date('F d Y', strtotime($staff->date_of_birth)) }}
                            @else
                                --
                            @endif
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Joined Date</dt>
                        <dd>
                            @if ($staff->joined_date && $staff->joined_date != '0000-00-00')
                                {{ date('F d Y', strtotime($staff->joined_date)) }}
                            @else
                                --
                            @endif
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
                        <dt>Email</dt>
                        <dd>{{ $staff->email }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Telephone</dt>
                        <dd>{{ ($staff->telephone) ? $staff->telephone : '--' }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Mobile</dt>
                        <dd>{{ $staff->mobile }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Address</dt>
                        <dd>{{ $staff->address }}, {{ $staff->city }}, {{ $staff->country->country_name }}</dd>
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
                        <dt>Full Name</dt>
                        <dd>{{ $staff->contact_person_title }} {{ $staff->contact_person_first_name }} {{ $staff->contact_person_last_name }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Relationship</dt>
                        <dd>{{ $staff->contact_person_relation }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Telephone</dt>
                        <dd>{{ $staff->contact_person_contact_no }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".sub-menu-company").addClass('active');
        $(".sub-menu-company").addClass('toggled');
        $(".sub-menu-staff-add").addClass('active');
    });

    function deleteStaff() {
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
                $("#deleteStaffForm").submit();
            }
        });
    }
</script>

@endsection