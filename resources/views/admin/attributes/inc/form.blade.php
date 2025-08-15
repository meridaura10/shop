{!! Lte3::text('name') !!}

{!! Lte3::select2('categories', isset($attribute) ? $attribute->categories->pluck('id')->toArray() : [], isset($attribute) ? $attribute->categories->pluck('name','id')->toArray() : [],[
     'label' => 'Categories',
     'multiple' => 1,
     'url_suggest' => route('admin.suggest.terms', \App\Models\Term::VOCABULARY_PRODUCT_CATEGORIES),
 ]) !!}

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Зберегти атрибут</button>
</div>


