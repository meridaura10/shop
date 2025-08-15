@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total: {{ $distributions->count() }}
                    <button type="button" class="btn btn-primary btn-xs ml-1" data-toggle="modal" data-target="#modalLeadMessage">
                        відправити повідомлення
                    </button>
                    @include('admin.distributions.create')
                </h3>

                <div class="card-tools">
                    <a href="http://shop.test/lte3/components?_export=csv" class="btn btn-default btn-xs"><i class="fas fa-upload"></i> Export</a>
                    <form class="js-form-submit-file-changed" action="http://shop.test/lte3/data/save" method="POST" enctype="multipart/form-data" style="display: inline-flex" accept-charset="UTF-8">

                        <input name="_method" value="POST" type="hidden">
                        <input name="_token" value="KiaOZIBukXxzsqLemLs1SdNQE9B386VQElbk6cVR" type="hidden">

                        <label class="btn btn-default btn-xs"><input type="file" hidden=""><i class="fas fa-download"></i> Import</label>
                    </form>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-source-selector="#card-refresh-content" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
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
                        <th  style="width: 10%">Actions</th>
                        <th  style="width: 30%">Name</th>
                        <th style="width: 15%">Date</th>
                        <th style="width: 15%">Time</th>
                        <th style="width: 15%">Status</th>
                    </tr>
                    </thead>

                    @foreach($distributions as $distribution)
                        <tr id="{{ $distribution->id }}" class="va-center ui-sortable-handle">
                            <td class="text-left space-1">
                                <form action="{{ route('admin.distributions.destroy', $distribution->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей продукт?')">
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
                                {!! Lte3::xEditable('message', $distribution->message, [
                                    'type' => 'textarea',
                                    'pk' => 1,
                                    'url_save' => route('admin.distributions.put', $distribution),
                                ]) !!}
                            </td>
                            <td>
                                {!! Lte3::xEditable('date', $distribution->send_at ? $distribution->send_at->format('Y-m-d') : null, [
                                     'type' => 'date',
                                     'pk' => 1,
                                     'url_save' => route('admin.distributions.put', $distribution),
                                ]) !!}
                            </td>
                            <td>
                                {!! Lte3::xEditable('time', $distribution->send_at ? $distribution->send_at->format('H:i') : null, [
                                     'type' => 'time',
                                     'pk' => 1,
                                     'url_save' => route('admin.distributions.put', $distribution),
                                ]) !!}
                            </td>
                            <td>
                                {!! Lte3::xEditable('status', \App\Models\Distribution::statusesList('name', 'key')[$distribution->status], [
                                    'value_title' => \App\Models\Distribution::statusesList('name', 'key')[$distribution->status],
                                    'type' => 'select',
                                    'source' => \App\Models\Distribution::statusesList('key', 'name', ['is_associative' => ['value', 'text']]),
                                    'url_save' => route('admin.distributions.put', $distribution),
                                ]) !!}
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>


        </div>
    </section>
@endsection




