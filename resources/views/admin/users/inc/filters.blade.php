{!! Lte3::text('email', request('email'), ['placeholder' => 'email']) !!}

{!! Lte3::datepicker('date', request('date') ?? null, [
    'label' => 'Date',
    'format' => 'Y-m-d',
]) !!}

@php
    $role = \Spatie\Permission\Models\Role::query()->find(request('role_id'))
@endphp

{!! Lte3::select2(
    'role_id',
        request('role_id')
        ? [$role->id => $role->name]
        : [],
    [],
    [
        'label' => 'Role',
        'empty_value'=> 'Роль',
        'url_suggest' => route('admin.suggest.roles', [
            'is_default' => true,
        ]),
    ]
) !!}
