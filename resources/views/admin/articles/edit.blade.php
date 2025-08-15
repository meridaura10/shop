@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Форма редагування статті/новини @if($article->name) - {{ $article->name }}@endif</h3>
            </div>

            {!! Lte3::formOpen([
                'action' => route('admin.articles.update', $article),
                'files' => true,
                'method' => 'patch',
                'style' => 'display: inline-flex',
                'model' => $article,
            ]) !!}
            <div class="card-body">


            @include('admin.articles.inc.form', compact('article'))

            </div>
            {!! Lte3::formClose() !!}
        </div>
    </section>
@endsection

@push('styles')
    <!-- summernote -->
    <link rel="stylesheet" href="/vendor/adminlte/plugins/summernote/summernote-bs4.min.css">

    <!-- CodeMirror -->
    <link rel="stylesheet" href="/vendor/adminlte/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="/vendor/adminlte/plugins/codemirror/theme/monokai.css">

    <!-- highlight.js -->
    <link rel="stylesheet" href="/vendor/lte3/plugins/highlightjs/styles/default.min.css">
@endpush

@push('scripts')
    <!-- Summernote -->
    <script src="/vendor/adminlte/plugins/summernote/summernote-bs4.min.js"></script>

    <!-- CodeMirror -->
    <script src="/vendor/adminlte/plugins/codemirror/codemirror.js"></script>
    <script src="/vendor/adminlte/plugins/codemirror/mode/css/css.js"></script>
    <script src="/vendor/adminlte/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="/vendor/adminlte/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <!-- highlight.js -->
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


