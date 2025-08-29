
{!! Lte3::text('name') !!}

{!! Lte3::textarea('description', null, [
         'label' => 'Description',
         'rows' => 3,
]) !!}

{!! Lte3::select2('status', null, \App\Models\Page::statusesList('key'), [
   'label' => 'Status',
]) !!}

{!! Lte3::textarea('content', null, [
         'label' => 'Content',
          'class' => 'f-tinymce',
         'rows' => 3,
]) !!}

@include('admin.seo.inc.form', ['model' => $page ?? null])

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


