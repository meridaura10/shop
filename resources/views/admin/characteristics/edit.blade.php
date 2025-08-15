<div class="modal-header">
    <h5 class="modal-title"><span class="font-weight-bold">Edit:</span> {{$characteristic->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{!! Lte3::formOpen([
     'action' => route('admin.characteristic.update', $characteristic),
     'files' => true,
     'method' => 'patch',
     'class' => 'js-form-submit-file-changed',
     'style' => 'display: inline-flex',
     'model' => $characteristic,
  ]) !!}
<div class="modal-content">
    <div class="modal-body">
        {!! Lte3::text('name') !!}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
{!! Lte3::formClose() !!}


