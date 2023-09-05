@extends('admin.layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Category List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Category List</li>
                        </ol>
                    </div>
                    @if (session('message'))
                        <div class="col-sm-12 alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-around">
                                <h3 class="card-title">Product List</h3>
                                <a class="btn btn-primary " href="{{ route('admin.product_category.add') }}">Add</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($productCategories as $productCategory)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $productCategory->name }} </td>
                                                <td>
                                                    <div
                                                        class="{{ $productCategory->status ? 'btn btn-success' : 'btn btn-danger' }}">
                                                        {{ $productCategory->status ? 'Show' : 'Hide' }}
                                                    </div>
                                                </td>
                                                <td>{{ $productCategory->created_at }}</td>
                                                <td>{{ $productCategory->updated_at }}</td>
                                                <td>
                                                    <a class="btn btn-primay"
                                                        href="{{ route('admin.product_category.detail', ['id' => $productCategory->id]) }}">Detail</a>
                                                    <a onclick="return confirm('Are You Sure???')" class="btn btn-danger"
                                                        href="{{ route('admin.product_category.destroy', ['id' => $productCategory->id]) }}">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="4">No Data</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
