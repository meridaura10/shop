@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    @include('admin.orders.table', compact('orders'))
@endsection



