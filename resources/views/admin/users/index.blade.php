@extends('admin.layouts.app')

@section('content')
    @include('admin.parts.content-header', ['page_title' => 'Dashboard v1'])

    <section class="content">
        <div class="card">
            <div class="card-header">
               <div class="card-header">
                   <h3 class="card-title">Total: {{ $users->total() }} <a href="{{ route('admin.users.create') }}" class="btn ml-3 btn-success btn-xs"><i class="fas fa-plus"></i> Create</a></h3>

                   <div class="card-tools">
                       <button type="button" class="btn btn-tool" data-source-selector="#card-refresh-content" data-card-widget="maximize">
                           <i class="fas fa-expand"></i>
                       </button>
                   </div>
               </div>
              <div>
                  {!! Lte3::formOpen([
                   'action' => route('admin.users.index'),
                   'files' => true,
                   'method' => 'get',
               ]) !!}
                  <div class="card-body d-flex flex-wrap" style="gap: 15px">
                      @include('admin.users.inc.filters')
                  </div>
                  <div class="p-3 bg-light border d-flex justify-content-between">
                          {!! Lte3::btnSubmit('Застосувати') !!}
                          <a href="{{ route('admin.users.index') }}">
                              <button type="button" class="btn btn-secondary">
                                  Скинути
                              </button>
                          </a>
                  </div>
                  {!! Lte3::formClose() !!}
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
                        <th  style="width: 18%">{!! \Sort::getSortLink('name', 'Name') !!}</th>
                        <th class="js-options-sum" style="width: 14%">Email/Verified</th>
                        <th class="js-options-name" style="width: 18%">Phone</th>
                        <th class="js-options-sum" style="width: 14%">Role</th>
                        <th class="js-options-sum" style="width: 14%">Status</th>
                        <th  style="width: 18%">{!! \Sort::getSortLink('created_at', 'Registered at') !!}</th>
                    </tr>
                    </thead>

                    @foreach($users as $user)
                        <tr id="{{ $user->id }}" class="va-center ui-sortable-handle">
                            <td class="text-left space-1">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>


                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цього користувача?')">
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
                                {{ $user->name }}
                            </td>
                            <td>
                               {{ $user->email }} / <span class="font-semibold">@if($user->email_verified_at) yes @else no @endif</span>
                            </td>
                            <td>
                                {{ $user->phone }}
                            </td>
                            <td>
                                @if(count($user->roles))
                                    {{ $user->roles[0]->name }}
                                @endif
                            </td>
                            <td>
                                {{ $user->status }}
                            </td>
                            <td>
                                {{ $user->created_at->format('y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    @if($users->hasPages())
        <section class="content">
            <div class="card">
                <div class="px-4 pt-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    @endif
@endsection



