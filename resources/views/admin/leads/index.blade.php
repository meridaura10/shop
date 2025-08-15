@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total: {{ $leads->total() }}
                </h3>
                <a href="{{ route('admin.leads.create') }}" class="btn ml-3 btn-success btn-xs">
                    <i class="fas fa-plus"></i>
                    Create
                </a>
                <button type="button" class="btn btn-primary btn-xs ml-1" data-toggle="modal" data-target="#modalLeadMessage">
                    відправити повідомлення
                </button>
                @include('admin.distributions.create')
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
                        <th class="js-options-name" style="width: 15%">Actions</th>
                        <th class="js-options-name" style="width: 10%">Fields</th>
                        <th class="js-options-name" style="width: 10%">Status</th>
                        <th class="js-options-name" style="width: 10%">Type</th>
                    </tr>
                    </thead>

                    @foreach($leads as $lead)
                        <tr id="{{ $lead->id }}" class="va-center ui-sortable-handle">
                            <td class="text-left space-1">
                                <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цього підписника?')">
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
                                @foreach($lead->fields as $field => $value)
                                    <div>
                                        {{ $field }} - {{ $value }}
                                    </div>
                                @endforeach
                            </td>
                            <td>
                               {{ $lead->status }}
                            </td>
                            <td>
                               {{ $lead->type }}
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>


        </div>
    </section>


    @if($leads->hasPages())
        <section class="content">
            <div class="card">
                <div class="px-4 pt-4">
                    {{ $leads->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    @endif
@endsection



