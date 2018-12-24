@extends('backend.master')
@section('content') 
@isset($travel)
<div class="row">
    @include('travel::components._progress')
</div>
@endisset
<div class="row">
    <div class="col">
        <div class='card align-middle' width="">
            <div class="card-header">
                <p class="card-title">
                    <i class="fe fe-document"></i> Permission To Travel (Overseas) Form</p>
                <div class="card-options">
                    <button class="btn btn-sm btn-" style="float:right">{{$travel->status()->reason}}
                        on {{$travel->created_at->toDayDateTimeString()}}</button>
                </div>
            </div>
            <div class='card-body'>
                <div class="row">
                    <div class="col">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="applicant-details-tab" data-toggle="tab" href="#applicant-details"
                                    role="tab" aria-controls="applicant-details" aria-selected="true"> <i class="fe fe-document"></i>
                                    Applicant Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="travel-info-tab" data-toggle="tab" href="#travel-info" role="tab"
                                    aria-controls="travel-info" aria-selected="false">
                                    <i class="fe fe-globe"></i> Event/Travel Information</a>
                            </li>
                            @if($financialaids->count() > 0)
                            <li class="nav-item">
                                <a class="nav-link" id="financial-aid-tab" data-toggle="tab" href="#financial-aid" role="tab"
                                    aria-controls="financial-aid" aria-selected="false">Financial Aid</a>
                            </li>
                            @endif
                            @if($participants->count() > 0)
                            <li class="nav-item">
                                <a class="nav-link" id="participants-tab" data-toggle="tab" href="#participants" role="tab"
                                    aria-controls="participants" aria-selected="false">Participants List</a>
                            </li>
                            @endif
                            @if($travel->attachments->count() > 0)
                            <li class="nav-item">
                                <a class="nav-link" id="attachment-tab" data-toggle="tab" href="#attachment" role="tab"
                                    aria-controls="attachment" aria-selected="false">Attachments</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="applicant-details" role="tabpanel"
                                aria-labelledby="applicant-details-tab">
                                @include('travel::show._applicant-details')</div>
                            <div class="tab-pane fade" id="travel-info" role="tabpanel" aria-labelledby="travel-info-tab">
                                @include('travel::show._travel-information')</div>
                            @if($financialaids->count() > 0)
                            <div class="tab-pane fade" id="financial-aid" role="tabpanel" aria-labelledby="financial-aid-tab">
                                @include('travel::show._financial-aid')</div>
                            @endif
                            @if($participants->count() > 0)
                            <div class="tab-pane fade" id="participants" role="tabpanel" aria-labelledby="participants-tab">
                                @include('travel::show._participants')
                            </div>
                            @endif
                            @if($travel->attachments->count() > 0)
                            <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment-tab">
                                @include('travel::show._attachments')</div>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <form action="" class="" method="POST">          
                            @csrf
                            <h4>Recommendations</h4>
                            @include('travel::components._remarks')
                        </form>
                    </div>


                </div>
            </div>


        </div>


    </div>
    @endsection