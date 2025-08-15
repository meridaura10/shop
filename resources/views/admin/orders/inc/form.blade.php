
{!! Lte3::select2('status', null, \App\Models\Order::statusesList('name', 'key'), [
   'label' => 'Status',
]) !!}


{!! Lte3::select2('type', null, \App\Models\Order::typesList('name', 'key'), [
   'label' => 'Type',
]) !!}

<div class="card">
    <div class="card-body">
        <div class="card-header">
            <h4>Customer</h4>
        </div>
       <div class="card-body">

           {!! Lte3::text('customer[first_name]', $order->customer['first_name'] ?? null, [
               'label' => 'First name',
            ]) !!}

           {!! Lte3::text('customer[last_name]', $order->customer['last_name'] ?? null, [
               'label' => 'Last name',
           ]) !!}

           {!! Lte3::text('customer[email]', $order->customer['email'] ?? null, [
              'label' => 'Email',
           ]) !!}

           {!! Lte3::number('customer[phone]', $order->customer['phone'] ?? null, [
              'label' => 'Phone',
           ]) !!}

           {!! Lte3::select2(
               'user_id',
               isset($order, $order->user)
                   ? [$order->user->id => $order->user->email]
                   : [],
               [],
               [
                   'label' => 'User',
                   'url_suggest' => route('admin.suggest.users'),
               ]
           ) !!}
       </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


