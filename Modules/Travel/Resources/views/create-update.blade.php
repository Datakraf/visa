@extends('backend.master')
@section('content')
@if(isset($travel))
<div class="row">
    <form action="{{route('travel.update',['id'=>$travel->id])}}" method="POST" enctype="multipart/form-data">
        {{method_field('PUT')}}
        @else
        <form action="{{route('travel.store')}}" method="POST" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="card">
                <div class="card-header" style="background:white">
                    <h3 class="card-title"><i class="fe fe-file-text"></i> {{isset($travel) ? 'Edit
                        Application':'New Application'}}</h3>
                    <div class="card-options" id="">
                        @include('travel::components._form-action-buttons')
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#profile">
                                <i class="fe fe-user"></i> View My Profile
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="help-block">Please fill in the form below accordingly. Field with asterisk (<span
                                    class="text-danger">*</span>) sign is compulsory.</p>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    @include('travel::components._application-type')
                    @include('travel::components._participants')
                    @include('travel::components._supervisor')
                    @include('travel::components._college-fellow')
                    @include('travel::components._travel-information')
                    @include('travel::components._financial-aid')
                </div>
            </div>


        </form>
</div>
@endsection
