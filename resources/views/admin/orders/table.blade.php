<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Total:
                @if(method_exists($orders, 'hasPages'))
                    {{ $orders->total() }}
                @else
                    {{ $orders->count() }}
                @endif
                <a href="{{ route('admin.orders.create') }}" class="btn mx-3 btn-success btn-xs"><i class="fas fa-plus"></i> Create</a></h3>
                <h5>
                    {{ isset($title) ? $title : '' }}
                </h5>
            <div class="card-tools">
                <a href="http://shop.test/lte3/components?_export=csv" class="btn btn-default btn-xs"><i class="fas fa-upload"></i> Export</a>
                <form class="js-form-submit-file-changed" action="http://shop.test/lte3/data/save" method="POST" enctype="multipart/form-data" style="display: inline-flex" accept-charset="UTF-8">

                    <input name="_method" value="POST" type="hidden">
                    <input name="_token" value="KiaOZIBukXxzsqLemLs1SdNQE9B386VQElbk6cVR" type="hidden">

                    <label class="btn btn-default btn-xs"><input type="file" hidden=""><i class="fas fa-download"></i> Import</label>
                </form>

                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-source-selector="#card-refresh-content" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover" >
                <tbody>
                <thead>
                <tr>
                    <th class="js-options-name" style="width: 15%">Actions</th>
                    <th class="js-options-name" style="width: 10%">Amount</th>
                    <th class="js-options-sum" style="width: 30%">Address</th>
                    <th class="js-options-sum" style="width: 30%">Customer</th>
                    <th class="js-options-name" style="width: 15%">Status</th>
                </tr>
                </thead>

                @foreach($orders as $order)
                    <tr id="{{ $order->id }}" class="va-center ui-sortable-handle">
                        <td class="text-left space-1">
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>


                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити це замовлення?')">
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
                            {{ $order->amount }}
                        </td>
                        <td>
                           {{ $order->address }}
                        </td>
                        <td>
                            @foreach($order->customer as $customerKey => $customerValue)
                                <div>
                                    {{ $customerKey }} -- {{ $customerValue }}
                                </div>
                            @endforeach
                        </td>
                        <td>
                            {{ $order->status }}
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>


    </div>
</section>


@if(method_exists($orders, 'hasPages') && $orders->hasPages())
    <section class="content">
        <div class="card">
            <div class="px-4 pt-4">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endif
