@extends('admin.layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product List</li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="" method="get">
                                            <input type="text" name="keyword" placeholder="Search...">
                                            <select name="orderBy">
                                                <option value="">---Please Select---</option>
                                                <option value="lasted">Lasted
                                                </option>
                                                <option value="oldest">Oldest
                                                </option>
                                            </select>
                                            <button type="submit">Search</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary " href="{{ route('admin.product.create') }}">Add</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Short Description</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $product->name }} </td>
                                                <td>
                                                    <div
                                                        class="{{ $product->status ? 'btn btn-success' : 'btn btn-danger' }}">
                                                        {{ $product->status ? 'Show' : 'Hide' }}
                                                    </div>
                                                </td>
                                                <td>{!! $product->short_description !!} </td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->updated_at }}</td>
                                                {{-- <td>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.product_category.detail', ['id' => $productCategory->id]) }}">Detail</a>
                                                    <a onclick="return confirm('Are You Sure???')" class="btn btn-danger"
                                                        href="{{ route('admin.product_category.destroy', ['id' => $productCategory->id]) }}">Delete</a>
                                                </td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">No Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $products->links() }}
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
