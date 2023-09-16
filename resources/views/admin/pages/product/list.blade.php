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
                                            <th>Image</th>
                                            <th>Product_category_name</th>
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
                                                @php
                                                    $imageLinks =
                                                        is_null($product->image) || !file_exists('images/' . $product->image)
                                                            ? 'data:image/png;base64,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'
                                                            : asset('images/' . $product->image);
                                                @endphp
                                                <td><img src="{{ $imageLinks }}" width="150px" alt=""></td>
                                                <td>{{ $product->product_category_name }}</td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->updated_at }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="return confirm('Are You Sure???')" type="submit"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.product.show', ['product' => $product->id]) }}">Edit</a>

                                                </td>
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
