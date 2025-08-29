<div class="card">
    <div class="card-header">
        Seo
    </div>
    <div class="card-body">
        {!! Lte3::text('seo[title]', $model?->seo?->tags['title'] ?? null, [
            'label' => 'Title',
        ]) !!}

        {!! Lte3::textarea('seo[description]', $model?->seo?->tags['description'] ?? null, [
                 'label' => 'Description',
                 'rows' => 3,
        ]) !!}

        {!! Lte3::textarea('seo[keywords]', $model?->seo?->tags['keywords'] ?? null, [
              'label' => 'Keywords',
              'rows' => 3,
     ]) !!}
    </div>
</div>
