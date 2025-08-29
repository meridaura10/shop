@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-header">
                    <h3 class="card-title">Total: {{ $reviews->count() }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-source-selector="#card-refresh-content" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
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
                        <th  style="width: 15%">Text</th>
                        <th style="width: 15%">Rating</th>
                        <th style="width: 15%">Parent</th>
                        <th style="width: 15%">Status</th>
                        <th  style="width: 13%">User</th>
                    </tr>
                    </thead>

                    @foreach($reviews as $review)
                        <tr id="{{ $review->id }}" class="va-center ui-sortable-handle">
                            <td class="text-left space-1">
                                <form action="{{ route('admin.reviews.destroy', ['review' => $review]) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей продукт?')">
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
                                {{ $review->name }}
                            </td>
                            <td>
                                {{ $review->rating }}
                            </td>
                            <td>
                                {{ $review->parent?->name }}
                            </td>
                            <td>
                                {!! Lte3::xEditable('status', \App\Models\Review::statusesList('name', 'key')[$review->status], [
                                         'value_title' => \App\Models\Review::statusesList('name', 'key')[$review->status],
                                         'type' => 'select',
                                         'source' => \App\Models\Review::statusesList('key', 'name', ['is_associative' => ['value', 'text']]),
                                         'url_save' => route('admin.reviews.put', ['product' => $product, 'review' => $review]),
                           ]) !!}
                            </td>
                            <td>
                                {{ $review->user?->name }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection



