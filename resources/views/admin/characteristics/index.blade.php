<div class="card">
    <div class="card-header text-center">
       <div class="d-flex justify-content-between align-items-center">
           <div>
               <h4>Characteristics</h4>
           </div>
           <div>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCharacteristicFormCreate">
                   create new
               </button>
           </div>
       </div>
    </div>

    @include('admin.characteristics.create')

    <div class="card-body">
        @foreach($attribute->characteristics as $characteristic)
            <div class="border-top p-3 d-flex justify-content-between align-items-center">
                <div>
                    <span class="font-weight-bold">Name:</span> {{ $characteristic->name }}
                </div>
                <div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.characteristic.edit', $characteristic) }}" type="button" class="btn btn-primary js-modal-fill-html" data-toggle="modal" data-target="#modal-lg">
                            Edit
                        </a>
                        <div class="ml-1">
                            <form action="{{ route('admin.characteristic.destroy', $characteristic) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цю характеристику?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
