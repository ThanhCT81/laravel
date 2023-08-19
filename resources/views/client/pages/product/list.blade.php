@extends('client.layout.master')

@section('content')
    Product list blade template
@endsection
@section('title')
    Product
@endsection
@section('side-bar')
    @parent
    <p>side bar of product list</p>
@endsection
