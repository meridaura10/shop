{!! Lte3::number('price') !!}
{!! Lte3::number('old_price') !!}
{!! Lte3::number('quantity') !!}

{!! Lte3::select2('product_id', null, [], [
    'label' => 'Product',
    'url_suggest' => route('admin.suggest.products'),
]) !!}
