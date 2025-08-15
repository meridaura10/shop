<div class="card">
    <div class="card-header text-center">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4>Purchases</h4>
            </div>
            <div>
                <button
                    type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPurchasesFormCreate">
                    create new
                </button>
            </div>
        </div>
    </div>


    @include('admin.purchases.create', compact('order'))
            <div class="card-body table-responsive p-0">
                <table class="table table-hover" >
                    <tbody>
                    <thead>
                    <tr>
                        <th class="js-options-name" style="width: 15%">Actions</th>
                        <th class="js-options-name" style="width: 15%">Image</th>
                        <th class="js-options-name" style="width: 18%">Name</th>
                        <th class="js-options-sum" style="width: 14%">Price/Old price</th>
                        <th class="js-options-sum" style="width: 14%">Quantity</th>
                        <th class="js-options-sum" style="width: 14%">Amount</th>
                    </tr>
                    </thead>

                    @foreach($order->purchases as $purchase)
                        <tr id="{{ $purchase->id }}" class="va-center ui-sortable-handle">
                            <td class="text-left space-1">
                                <form action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей продукт?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 m-0 p-0 bg-transparent">
                                        <span class=" btn btn-danger border-none btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div>
                                    @if($src = $purchase->getFirstMediaUrl('image','thumb'))
                                        <a href="{{ $src }}" class="js-popup-image">
                                            <img src="{{ $src }}" class="img-thumbnail object-fit-cover" style="max-width: 100px">
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                {{ $purchase->name }}
                            </td>
                            <td>
                                {!! Lte3::xEditable('price', $purchase->price, [
                                    'type' => 'number',
                                    'url_save' => route('admin.purchases.put', $purchase),
                                ]) !!}
                                <div>
                                    {!! Lte3::xEditable('old_price', $purchase->old_price, [
                                       'type' => 'number',
                                       'url_save' => route('admin.purchases.put', $purchase),
                                   ]) !!}
                                </div>
                            </td>
                            <td>
                                {!! Lte3::xEditable('quantity', $purchase->quantity, [
                                    'type' => 'number',
                                    'url_save' => route('admin.purchases.put', $purchase),
                                ]) !!}
                            </td>
                            <td>
                                {{ $purchase->amount }}
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
</div>

