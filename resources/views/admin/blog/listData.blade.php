@extends('admin.layouts.default')

@section('title', 'Blog ')

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
                <h5 class="panel-title">Blog </h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li style="margin-right: 10px;"><a href="{{ route('blog.create') }}" class="btn btn-primary add-new">Add New</a></li>
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($blog))
                            @foreach ($blog as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->sub_title }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                        <img class="img-fluid" width="120" height="80" src="{{ asset('uploads/blogThumb/'.$value->thumbnail) }}" alt="Blog Thumbnail">
                                    </td>
                                    <td>
                                        @if ($value->valid == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('blog.edit', $value->id) }}"><i class="icon-pencil"></i></a>

                                        <form action="{{ route('blog.destroy', $value->id) }}" method="POST" >
                                                @method('DELETE')
                                                @csrf
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this');"><i class="icon-bin"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No Data found!</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /basic datatable -->

    </div>
    <!-- /content area -->
@endsection
