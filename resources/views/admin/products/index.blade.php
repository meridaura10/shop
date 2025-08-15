@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-header">
                    <h3 class="card-title">Total: {{ $products->total() }} <a href="{{ route('admin.products.create') }}" class="btn ml-3 btn-success btn-xs"><i class="fas fa-plus"></i> Create</a></h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.products.export') }}" class="btn btn-default btn-xs"><i class="fas fa-upload"></i> Export</a>
                        <form class="js-form-submit-file-changed" action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" style="display: inline-flex" accept-charset="UTF-8">
                            @method('POST')
                            @csrf

                            <label class="btn btn-default btn-xs"><input name="file" type="file" hidden=""><i class="fas fa-download"></i> Import</label>
                        </form>
                        <button type="button" class="btn btn-tool" data-source-selector="#card-refresh-content" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div>
                    {!! Lte3::formOpen([
                     'action' => route('admin.products.index'),
                     'files' => true,
                     'method' => 'get',
                 ]) !!}
                    <div class="card-body d-flex flex-wrap" style="gap: 15px">
                        @include('admin.products.inc.filters')
                    </div>
                    <div class="p-3 bg-light border d-flex justify-content-between">
                        {!! Lte3::btnSubmit('Застосувати') !!}
                        <a href="{{ route('admin.products.index') }}">
                            <button type="button" class="btn btn-secondary">
                                Скинути
                            </button>
                        </a>
                    </div>
                    {!! Lte3::formClose() !!}
                </div>

            </div>

        </div>
    </section>


    <section class="content">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover" >
                    <tbody>
                    <thead>
                    <tr>
                        <th  style="width: 15%">Actions</th>
                        <th style="width: 15%">Image</th>
                        <th  style="width: 18%">{!! \Sort::getSortLink('name', 'Name') !!}</th>
                        <th  style="width: 14%">{!! \Sort::getSortLink('price', 'Price') !!}/{!! \Sort::getSortLink('old_price', 'Old Price') !!}</th>
                        <th  style="width: 7%">{!! \Sort::getSortLink('quantity', 'Quantity') !!}</th>
                        <th  style="width: 13%">Brand</th>
                        <th  style="width: 15%">Category</th>
                    </tr>
                    </thead>

                    @foreach($products as $product)
                        <tr id="{{ $product->id }}" class="va-center ui-sortable-handle">
                            <td class="text-left space-1">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>


                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей продукт?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 m-0 p-0 bg-transparent">
                                        <span class=" btn btn-danger border-none btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </button>
                                </form>

                            </td>
                            <td>
                                @if($src = $product->getFirstMediaUrl('images','thumb'))
                                    <a href="{{ $src }}" class="js-popup-image">
                                        <img src="{{ $src }}" class="img-thumbnail object-fit-cover" style="max-width: 100px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $product->price }} / {{ $product->old_price }}
                            </td>
                            <td>
                                {{ $product->quantity }}
                            </td>
                            <td>
                                {{ $product->brand?->name }}
                            </td>
                            <td>
                                {{ $product->category?->name }}
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>


        </div>
    </section>


   @if($products->hasPages())
       <section class="content">
           <div class="card">
               <div class="px-4 pt-4">
                   {{ $products->links('pagination::bootstrap-5') }}
               </div>
           </div>
       </section>
   @endif
@endsection



