@extends('admin.layouts.default')

@section('title', 'Blog Category')

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
                <h5 class="panel-title">Blog Category</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li style="margin-right: 10px;"><a href="{{ route('blogCategory.create') }}" class="btn btn-primary add-new">Add New</a></li>
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
                            <th>Name</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($blogCategories))
                            @foreach ($blogCategories as $key => $category)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->valid == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('blogCategory.edit', $category->id) }}"><i class="icon-pencil"></i></a>

                                        <form action="{{ route('blogCategory.destroy', $category->id) }}" data-type="" method="POST" class="data-delete" delete-link="{{ route('blogCategory.destroy', $category->id) }}">
                                                @method('DELETE')
                                                @csrf
                                            <button type="submit" ><i class="icon-bin"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No Data found!</td>
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
