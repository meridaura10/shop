@php
    $values = is_object($variables) ? (array) $variables : $variables;

    if(isset($parentName)) {
        $inputName = is_string($key) ? $parentName . "[$key]" : $parentName . "[]";
    } else {
        $inputName = is_string($key) ? $key : '';
    }
@endphp

@if(is_array($values))
    <div style="margin-left: {{ $level ?? 0 }}px;">
        @if(is_string($key))
            <div class="mb-2">
                <strong>{{ $key }}:</strong>
            </div>
        @endif

        @foreach($values as $subKey => $subValue)
            @include('admin.variables.inc.variable', [
                'key' => $subKey,
                'variables' => $subValue,
                'parentName' => $inputName,
                'level' => ($level ?? 0) + 20
            ])
        @endforeach
    </div>
@else
    <div class="mb-2" style="margin-left: {{ $level ?? 0 }}px;">
        @if(is_string($key))
            <label>{{ $key }}</label>
        @endif
        <input type="text" name="{{ $inputName }}" value="{{ $values }}" class="form-control">
    </div>
@endif
