@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title d-flex">
                    <div>
                        Total: {{ $sitemap->count() }}
                    </div>
                    <form method="post" action="{{ route('admin.settings.sitemap.regenerate') }}">
                        @method('POST')
                        @csrf
                        <button type="submit" class="btn ml-3 btn-success btn-xs">regenerate</button>
                    </form>
                </h3>

                <div class="card-tools">
                    <a href="http://shop.test/lte3/components?_export=csv" class="btn btn-default btn-xs"><i class="fas fa-upload"></i> Export</a>

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
                        <th class="js-options-name" style="width: 80%">Uri</th>
                        <th class="js-options-name" style="width: 20%">Last mode</th>
                    </tr>
                    </thead>

                    @foreach($sitemap as $item)
                        <tr>
                            <td>
                                {{ $item['loc'] }}
                            </td>
                            <td>
                                {{ $item['lastmod'] }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


{{--    @if($articles->hasPages())--}}
{{--        <section class="content">--}}
{{--            <div class="card">--}}
{{--                <div class="px-4 pt-4">--}}
{{--                    {{ $articles->links('pagination::bootstrap-5') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}
@endsection





