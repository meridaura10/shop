<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $vocabulary['name'] }}<a href="{{ route('admin.terms.create', $vocabulary['slug']) }}" class="btn ml-3 btn-success btn-xs"><i class="fas fa-plus"></i> Create</a></h3>
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
        <div class="card-body">
            {!! Lte3::nestedset($terms, [
                    'label' => 'Models',
                    'has_nested' => true,
                    'routes' => [
                        'create' => 'admin.terms.create',
                        'edit' => 'admin.terms.edit',
                        'delete' => 'admin.terms.destroy',
                        'order' => 'admin.terms.order',
                        'params' => [$vocabulary['slug']],
                    ],
            ]) !!}
        </div>
    </div>
</section>
