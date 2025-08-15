{!! Lte3::text('name') !!}

{!! Lte3::select2('permissions', isset($role) ? $role->permissions->pluck('id')->toArray() : [], isset($role) ? $role->permissions->pluck('name','id')->toArray() : [],[
     'label' => 'Permissions',
     'multiple' => 1,
     'url_suggest' => route('admin.suggest.permissions'),
 ]) !!}

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
