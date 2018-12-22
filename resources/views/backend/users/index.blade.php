@extends('backend.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fe fe-users"></i> Users</h3>
        <div class="card-options">
            <a class="btn btn-secondary btn-sm">Total: {{ $result->count() }} {{ str_plural('User', $result->count())
                }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="datatable">
                <thead>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    @can('edit_users', 'delete_users')
                    <th class="text-center">Actions</th>
                    @endcan
                </thead>
                <tbody>
                    @foreach($result as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-center">
                            <div class="avatar d-block" style="background-image: url({{asset($user->profile->avatar)}})">
                            </div>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->implode('name', ', ') }}</td>
                        <td>{{ $user->created_at->toDayDateTimeString() }}</td>

                        @can('edit_users')
                        <td class="text-center">
                            @can('edit_users')
                            <a href="{{ route('users.edit', ['id' => $user->id])  }}" class="btn btn-secondary btn-sm"><i
                                    class="fe fe-edit"></i>
                                Edit</a>
                            @endcan

                            @can('delete_users')
                            <form action="route('users.destroy', ['id' => $user->id]" method="POST" style="display:inline">
                                @csrf
                                {{method_field('DELTE')}}
                                <button class="btn btn-delete btn-sm btn-danger" type="submit"> <i class="fe fe-trash"></i>
                                    Delete</button>
                            </form>
                            @endcan
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('asset-partials.datatables')
@endsection
