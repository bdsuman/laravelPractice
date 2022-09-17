@extends('admin.layouts.default')

@section('title', 'Blog Category Update')

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="datatable_basic.html">Datatables</a></li>
                <li class="active">Basic</li>
            </ul>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Update Blog Category</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('blogCategory.update', $blogCategoryInfo->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <fieldset class="content-group">
                        <legend class="text-bold"></legend>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" value="{{ $blogCategoryInfo->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Status</label>
                            <div class="col-lg-10">
                                <select name="valid" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" @if ($blogCategoryInfo->valid == 1) selected @endif>Active</option>
                                    <option value="0" @if ($blogCategoryInfo->valid == 0) selected @endif>In Active</option>
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                        <a href="{{ route('blogCategory.index') }}" class="btn btn-default">Back To List</a>
                    </div>

                </form>
            </div>
        </div>
        <!-- /basic datatable -->

    </div>
    <!-- /content area -->
@endsection
