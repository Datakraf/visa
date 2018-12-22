@extends('backend.master')
@section('content')
<form action="{{route('profile.update',['id'=> Auth::user()->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url({{asset('img/photos/bg-profile.jpg')}});"></div>
                <div class="card-body text-center">
                    <img class="card-profile-img" src="{{asset($user->profile->avatar)}}">
                    <h3 class="mb-3">{{$user->name}}</h3>
                    <div class="input-file-container text-center">
                        <input class="input-file" id="my-file" type="file" name="avatar">
                        <label tabindex="0" for="my-file" class="input-file-trigger btn btn-sm">Change profile picture</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit {{ Auth::id() == $user->id ? 'Your Profile':$user->name }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        <label for="">Name</label>
                        <input type="text" class="form-control" placeholder="Name" value="{{old('name',$user->name?:null)}}">
                        @if ($errors->has('name'))
                        <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <label for="">Email</label>
                        <input type="text" class="form-control" value="{{old('email',$user->email?:null)}}">
                        @if ($errors->has('email'))
                        <p class="help-block">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        <label for="">Password</label>
                        <input type="password" class="form-control" placeholder="Password">
                        @if ($errors->has('password'))
                        <p class="help-block">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary">
                            {{ isset($user->id) ? 'Update':'Create'}}
                        </button>
                        <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@include('asset-partials.input-file')
