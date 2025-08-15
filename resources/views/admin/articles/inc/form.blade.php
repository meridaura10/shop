
{!! Lte3::text('name') !!}

{!! Lte3::textarea('description', null, [
         'label' => 'Description',
         'rows' => 3,
]) !!}

{!! Lte3::number('weight') !!}

{!! Lte3::select2('type', null, \App\Models\Article::typesList('key'), [
   'label' => 'Type',
   'empty_value' => 'немає типу в категорії',
]) !!}

{!! Lte3::select2('status', null, \App\Models\Article::statusesList('key'), [
   'label' => 'Status',
]) !!}

{!! Lte3::select2('category_id', isset($article?->category_id) ? $article->category_id : null, isset($article?->category_id) ? [$article->category_id => $article->category->name] : [], [
   'label' => 'category',
   'url_suggest' => route('admin.categories.suggest'),
   'empty_value' => 'немає категорії',
]) !!}

{!! Lte3::mediaImage('images', [] ,[
    'multiple' => 1,
]) !!}


<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


