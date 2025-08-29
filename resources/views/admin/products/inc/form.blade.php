
{!! Lte3::text('name') !!}

{!! Lte3::text('slug') !!}

{!! Lte3::number('price') !!}

{!! Lte3::number('old_price') !!}

{!! Lte3::number('quantity') !!}

{!! Lte3::textarea('description', null, [
    'label' => 'Description',
    'rows' => 3,
]) !!}

{!! Lte3::select2('status', null, \App\Models\Product::statusesList('name', 'key'), [
   'label' => 'Status',
]) !!}

<div class="card">
   <div class="card-body">
       {!! Lte3::select2('category_id', isset($product?->category_id) ? $product->category->id : null, isset($product?->category) ? [$product->category->id => $product->category->name] : [], [
             'label' => 'Головна категорія',
             'url_suggest' => route('admin.suggest.terms', \App\Models\Term::VOCABULARY_PRODUCT_CATEGORIES),
         ]) !!}


       {!! Lte3::select2('categories', isset($product) ? $product->categories->pluck('id')->toArray() : [], isset($product) ? $product->categories->pluck('name','id')->toArray() : [],[
            'label' => 'Categories',
            'multiple' => 1,
            'url_suggest' => route('admin.suggest.terms', \App\Models\Term::VOCABULARY_PRODUCT_CATEGORIES),
        ]) !!}
   </div>
</div>

@isset($attributes,$product)
    @if($attributes->count())
        <div class="card">
            <div class="card-header">
                <h3 class=" text-center">characteristics</h3>
            </div>
            <div class="card-body">
                @foreach($attributes as $attribute)
                    {!! Lte3::select2('characteristics['.$attribute->id.']',
                            $product->characteristics->where('attribute_id', $attribute->id)->first()?->id ?? 0,
                            $attribute->characteristics->pluck('name','id')->toArray(),
                            [
                            'label' => $attribute->name,
                             'empty_value' => '--',
                            ]) !!}
                @endforeach
            </div>
        </div>
    @endif
@endisset

<div class="card">
    <div class="card-body">
        {!! Lte3::mediaImage('images', [] ,[
            'multiple' => 1,
        ]) !!}
    </div>
</div>

@include('admin.seo.inc.form', ['model' => $product ?? null])

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


