<!-- resources/views/product/product-category-edit.blade.php -->
@extends('layouts.master')

@section('title', 'Product Category')

@section('content')
<div class="block-header">
    <h2>Inventory</h2>
</div>

<div class="card" id="profile-main">
    <div class="card-header">
        <h2>Edit Category</h2>
    </div>

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

        <form method="POST" action="/category/update">
        {!! csrf_field() !!}
            <div class="pmb-block">
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-city-alt m-r-5"></i> Edit Category Details - {{ $category->name }}</h2>
                </div>
                <div class="pmbb-body p-l-30">
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Name</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="name" value="{{ $category->name }}" />
                            </div>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt class="p-t-10">Description</dt>
                            <dd>
                            <div class="fg-line">
                                <input type="text" class="form-control" placeholder="" name="description" value="{{ $category->description }}" />
                            </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="row pull-right">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <button class="btn bgm-teal m-r-10" type="submit">Update</button>
                        <button class="btn bgm-gray" type="reset">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".sub-menu-inventory").addClass('active');
        $(".sub-menu-inventory").addClass('toggled');
        $(".sub-menu-product-category").addClass('active');
    });
</script>
@endsection
