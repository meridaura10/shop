@unless ($breadcrumbs->isEmpty())
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>
                        {{ $breadcrumbs->last()->title }}
                    </h4>
                    <div class="breadcrumb__links">
                        @foreach ($breadcrumbs as $breadcrumb)

                            @if ($breadcrumb->url && !$loop->last)
                                <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                            @else
                                <span class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</span>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endunless
