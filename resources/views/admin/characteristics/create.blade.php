@push('modals')
    <div class="modal fade" id="modalCharacteristicFormCreate" tabindex="-1" aria-labelledby="modalCharacteristicFormCreate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="font-weight-bold">Create new Characteristic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Lte3::formOpen([
                     'action' => route('admin.characteristic.store', $attribute),
                     'files' => true,
                     'method' => 'post',
                     'class' => 'js-form-submit-file-changed',
                     'style' => 'display: inline-flex',
                  ]) !!}
                <div class="modal-content">
                    <div class="modal-body">
                        @include('admin.characteristics.inc.form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                {!! Lte3::formClose() !!}
            </div>
        </div>
    </div>
@endpush
