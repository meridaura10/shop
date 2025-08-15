<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $vocabulary['name'] }}: {{ $terms->count() }} <a href="{{ route('admin.terms.create', $vocabulary['slug']) }}" class="btn ml-3 btn-success btn-xs"><i class="fas fa-plus"></i> Create</a></h3>

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
    </div
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
                    <th style="width: 15%">Name</th>
                    <th  style="width: 18%">Slug</th>
                    <th  style="width: 14%">Body</th>
                </tr>
                </thead>

                @foreach($terms as $term)
                    <tr id="{{ $term->id }}" class="va-center ui-sortable-handle">
                        <td class="text-left space-1">
                            <a href="{{ route('admin.terms.edit', $term)}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>


                            <form action="{{ route('admin.terms.destroy', $term->id) }}" method="POST" onsubmit="return confirm('Ви впевнені що хочете видалити?')">
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
                            @if($src = $term->getFirstMediaUrl('image','thumb'))
                                <a href="{{ $src }}" class="js-popup-image">
                                    <img src="{{ $src }}" class="img-thumbnail object-fit-cover" style="max-width: 100px">
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ $term->name }}
                        </td>
                        <td>
                            {{ $term->slug }}
                        </td>
                        <td>
                            {{ $term->body }}
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>


    </div>
</section>




