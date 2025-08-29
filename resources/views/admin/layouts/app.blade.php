@include('lte3::layouts.inc.begin')
@push('styles')
    <!-- summernote -->
    <link rel="stylesheet" href="/vendor/adminlte/plugins/summernote/summernote-bs4.min.css">

    <!-- CodeMirror -->
    <link rel="stylesheet" href="/vendor/adminlte/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/codemirror/theme/monokai.css">

    <!-- highlight.js -->
    <link rel="stylesheet" href="/vendor/lte3/plugins/highlightjs/styles/default.min.css">
@endpush
<div class="wrapper">
    @includeWhen(config('lte3.view.preloader'), 'lte3::layouts.inc.preloader')
    @include('admin.layouts.inc.navbar')
    @include('admin.layouts.inc.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
    @include('lte3::layouts.inc.footer')
</div>
@include('lte3::layouts.inc.end')

@push('scripts')

    <script src="/vendor/adminlte/plugins/codemirror/codemirror.js"></script>
    <script src="/vendor/adminlte/plugins/codemirror/mode/css/css.js"></script>
    <script src="/vendor/adminlte/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="/vendor/adminlte/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script src="/vendor/lte3/plugins/highlightjs/highlight.min.js"></script>
    <script src="/vendor/lte3/plugins/highlightjs/languages/php.min.js"></script>
@endpush
@push('modals')
    <div class="modal fade" id="my-modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><p>One fine body&hellip;</p></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endpush


