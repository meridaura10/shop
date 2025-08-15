{!! Lte3::text('name', null) !!}

{!! Lte3::text('email', null, ['type' => 'email']) !!}

{!! Lte3::number('phone', null) !!}

{!! Lte3::text('password', null, ['type' => 'password']) !!}

{!! Lte3::text('password_confirmation', null, ['type' => 'password']) !!}

{!! Lte3::mediaImage('avatar', []) !!}

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

