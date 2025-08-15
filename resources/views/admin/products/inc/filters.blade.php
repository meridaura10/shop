{!! Lte3::text('name', request('name'), ['placeholder' => 'Назва']) !!}

{!! Lte3::number('price_from', request('price_from', \App\Models\Product::query()->min('price')), ['placeholder' => 'Ціна від']) !!}
{!! Lte3::number('price_to', request('price_to', \App\Models\Product::query()->max('price')), ['placeholder' => 'Ціна до']) !!}

@php
    $category = \App\Models\Term::whereProductCategories()->find(request('category_id'))
@endphp

{!! Lte3::select2(
    'category_id',
        request('category_id')
        ? [$category->id => $category->name]
        : [],
    [],
    [
        'label' => 'Category',
        'empty_value'=> 'Категорія',
        'url_suggest' => route('admin.suggest.terms', [
            \App\Models\Term::VOCABULARY_PRODUCT_CATEGORIES,
            'is_default' => true,
        ]),
    ]
) !!}

{!! Lte3::select2(
    'has_photo',
    request('has_photo'),
    [
        '2' => 'З фото',
        '1' => 'Без фото'
    ],
    [
        'label' => 'Наявність фото',
        'empty_value'=> 'Усі',
    ]
) !!}
