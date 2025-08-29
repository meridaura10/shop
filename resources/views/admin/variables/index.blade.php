@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <div class="card">
        <div class="card-header">
             <h4>
                 Налаштування
             </h4>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.variables.create') }}">
                <button class="btn btn-primary">
                    Нова змінна
                </button>
            </a>
        </div>
    </div>

   <div class="content">
       @foreach(\Fomvasss\Variable\Facade::all() as $variable)
           {!! Lte3::formOpen([
             'action' => route('admin.variables.update', $variable),
             'files' => true,
             'method' => 'patch',
             'model' => $variable,
         ]) !!}
           <div class="card mb-3">
               <div class="card-header" style="background: steelblue; color: #fff;">
                   {{ $variable->key }}
               </div>
               <div class="card-body">
                   @if(is_array(json_decode($variable->value)) || is_object(json_decode($variable->value)))
                       @foreach(\Fomvasss\Variable\Facade::getArray($variable->key) as $fieldName => $values)
                           @include('admin.variables.inc.variable', [
                               'key' => $fieldName,
                               'variables' => $values,
                               'parentName' => $variable->key,
                               'level' => 0
                           ])
                       @endforeach
                   @else
                       @include('admin.variables.inc.variable', [
                              'key' => $fieldName,
                              'variables' => \Fomvasss\Variable\Facade::get($variable->key),
                              'parentName' => $variable->key,
                              'level' => 0
                          ])
                   @endif
               </div>

               <div class="card-footer">
                   <button type="submit" class="btn btn-primary">Save</button>
               </div>
           </div>
           {!! Lte3::formClose() !!}
       @endforeach

   </div>
{{--    <section class="content">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">Total: {{ $variables->count() }} <a href="{{ route('admin.variables.create') }}" class="btn ml-3 btn-success btn-xs"><i class="fas fa-plus"></i> Create</a></h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section class="content">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body table-responsive p-0">--}}
{{--                <table class="table table-hover" >--}}
{{--                    <tbody>--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="js-options-name" style="width: 15%">Actions</th>--}}
{{--                        <th class="js-options-sum" style="width: 14%">Key</th>--}}
{{--                        <th class="js-options-name" style="width: 18%">Value</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}

{{--                    @foreach($variables as $variable)--}}
{{--                        <tr id="{{ $variable->id }}" class="va-center ui-sortable-handle">--}}
{{--                            <td class="text-left space-1">--}}
{{--                                <a href="{{ route('admin.variables.edit', $variable) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>--}}
{{--                                <form action="{{ route('admin.variables.destroy', $variable->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цю змінну?')">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="border-0 m-0 p-0 bg-transparent">--}}
{{--                                        <span class=" btn btn-danger border-none btn-sm">--}}
{{--                                            <i class="fas fa-trash"></i>--}}
{{--                                        </span>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $variable->key }}--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{ $variable->value }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection



