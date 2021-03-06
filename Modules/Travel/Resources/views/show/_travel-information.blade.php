<div class="mt-5">
</div>
<div class="col">
    <table class="table table-striped table-bordered">
        <tr>
            <td><label for="" class="form-label">Title of Activity/Event</label></td>
            <td>{{$travel->title}}</td>
        </tr>
        <tr>
            <td><label for="" class="form-label">Justification For Attending The Visit</label></td>
            <td>{{$travel->description}}</td>
        </tr>
        <tr>
            <td><label for="" class="form-label">Venue</label></td>
            <td>{{$travel->venue}}</td>
        </tr>
        <tr>
            <td><label for="" class="form-label">State</label></td>
            <td>{{$travel->state}}</td>
        </tr>
        <tr>
            <td><label for="" class="form-label">Country</label></td>
            <td>{{$travel->country}} {!! $flag_icon[0]!!}</td>
        </tr>
        <tr>
            <td><label for="" class="form-label">Event Period</label></td>
            <td>
                <table class="table">
                    <tr>
                        <td><label for="" class="form-label">Start Date</label> </td>
                        <td><label for="" class="form-label">End Date</label></td>
                        <td><label for="" class="form-label">Total Days</label></td>
                    </tr>
                    <tr>
                        <td>{{$travel->event_start_date}}</td>                      
                        <td>{{$travel->event_end_date}}</td>
                        <td>{{getEventTotalDays($travel)}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><label for="" class="form-label">Travelling Period</label></td>
            <td>
                <table class="table">
                    <tr>
                        <td><label for="" class="form-label">Start Date</label></td>
                        <td><label for="" class="form-label">End Date</label></td>
                        <td><label for="" class="form-label">Total Days</label></td>
                    </tr>
                    <tr>

                        <td>{{$travel->travel_start_date}}</td>
                        <td>{{$travel->travel_end_date}}</td>
                        <td>{{getTravelTotalDays($travel)}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>


@section('page-css')
<link rel="stylesheet" href="{{asset('vendors/flag-icon-css-3/css/flag-icon.css')}}">
@endsection