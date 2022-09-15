@extends('admin.layouts.default')

@section('title', 'Blog Create')

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
                <h5 class="panel-title">Create Blog </h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('blog.store') }}" method="POST">
                    @csrf

                    <fieldset class="content-group">
                        <legend class="text-bold"></legend>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Category</label>
                            <div class="col-lg-10">
                                <select name="category_id" class="form-control">

                                    <option value="">Select Category</option>
                                    @foreach ($blogCategories as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Title</label>
                            <div class="col-lg-10">
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Sub Title</label>
                            <div class="col-lg-10">
                                <input type="text" name="sub_title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Description</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" name="description" placeholder="Write Short Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Image</label>
                            <div class="col-lg-10">
                                <input type="file" name="thumbnail" class="form-control" accept="image/*"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Status</label>
                            <div class="col-lg-10">
                                <select name="valid" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">In Active</option>
                                </select>
                            </div>
                        </div>

                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                        <a href="{{ route('blog.index') }}" class="btn btn-default">Back To List</a>
                    </div>

                </form>
            </div>
        </div>
        <!-- /basic datatable -->

    </div>
    <!-- /content area -->
@endsection
