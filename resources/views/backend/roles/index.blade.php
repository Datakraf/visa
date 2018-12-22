@extends('backend.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fe fe-lock"></i> Roles & Permissions</h3>
    </div>
    <div class="card-body">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Role Name</label>
                <input type="text" class="form-control" name="name">
                @if ($errors->has('name'))
                <p class="help-block">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
        @forelse ($roles as $role)
        <form action="{{route('roles.update',['id'=>$role->id])}}" method="POST">
            @csrf
            {{method_field('PUT')}}
            @if($role->name === 'Admin')
            @include('shared._permissions', [ 'title' => $role->name .' Permissions', 'options'=> ['disabled'] ])
            @else
            @include('shared._permissions', ['title' => $role->name .' Permissions', 'model' => $role ])            
            @endif
        </form>
        @empty
        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
        @endforelse
    </div>
</div>
@endsection
