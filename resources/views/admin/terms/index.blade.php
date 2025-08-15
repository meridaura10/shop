@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])


    @if($vocabulary['has_nested'])
        @include('admin.terms.tree')
    @else
        @include('admin.terms.table')
    @endif
@endsection




