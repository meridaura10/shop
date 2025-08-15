{!! Lte3::text('name') !!}

{!! Lte3::text('slug') !!}

{!! Lte3::textarea('body', null, [
         'label' => 'Body',
         'rows' => 3,
]) !!}

{!! Lte3::select2('status', null, \App\Models\Term::statusesList('key'), [
   'label' => 'Status',
]) !!}

{!! Lte3::mediaImage('image', []) !!}

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

