
{!! Lte3::text('name') !!}

{!! Lte3::email('email') !!}

{!! Lte3::number('phone') !!}

{!! Lte3::select2('status', isset($user) ? $user->status : null, \App\Models\User::statusesList('key'), [
   'label' => 'Status',
]) !!}

{!! Lte3::select2(
    'role_id',
    isset($user) && $user->roles->isNotEmpty()
        ? [$user->roles[0]->id => $user->roles[0]->name]
        : [0 => 'немає ролі'],
    [],
    [
        'label' => 'Role',
        'url_suggest' => route('admin.suggest.roles'),
        'empty_value' => 'немає ролі',
    ]
) !!}

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


