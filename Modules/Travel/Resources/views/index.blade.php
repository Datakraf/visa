@extends('backend.master')
@section('content')
<div class='card'>
    <div class='card-header'>
        <p class='card-title'><i class="fe fe-document"></i> My travels </p>
        <div class="card-options">
            <a class="btn btn-secondary btn-sm">Total: {{ $travels->count() }} {{ str_plural('travel',
                $travels->count()) }}</a>
            @can('add_travels')
            <a href="{{ route('travels.create') }}" class="btn btn-primary btn-sm text-white">
                <i class=""></i> Create</a> @endcan
        </div>
    </div>
    <div class='card-body'>
        <div class="table-responsive">
            <table class="table text-nowrap card-table table-striped" id="datatable">
                <thead>
                    <th>#</th>
                    <th>Event Title</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($travels as $key => $travel)
                    @if($travels->count() > 0)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{str_limit($travel->title,$limit = 40,$end = '...')}}</td>
                        <td>{{$travel->created_at->toDayDateTimeString()}}</td>
                        <td></td>
                        <td>
                            @can('view_travels')
                            <a href="" class="btn btn-secondary btn-sm"><i class="fe fe-eye"></i> View</a>
                            @endcan

                            @can('edit_travels')
                            <a href="" class="btn btn-secondary btn-sm"><i class="fe fe-edit"></i> Edit</a>
                            @endcan

                            @can('delete_travels')
                            <form action="{{route('travel.destroy',['id'=>$travel->id])}}" class="delete-travel" method="POST" style="display:inline">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn-delete btn btn-sm btn-danger">
                                    <i class="fe fe-trash"></i> Delete
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endif 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@include('asset-partials.datatables')
@section('page-js')
<script type="text/javascript">
    $(".delete-travel").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                $(".delete-travel").submit();
            }
        });
    });

</script>
@endsection
