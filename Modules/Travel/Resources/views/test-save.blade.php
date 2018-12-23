@extends('backend.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            Financial Aid
        </h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="text-right mb-5">
                <a class="btn btn-sm btn-secondary" id="add-financial">
                    <i class="fe fe-plus-circle"></i> Add Financial Aid(s)
                </a>
            </div>
            <form action="{{route('test.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-striped table-bordered financial-aid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sources Of Financial Assistance For The Visit<span class="text-danger">*</span></th>
                            <th>Details<span class="text-danger">*</span></th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic_field">
                        @isset($travel)
                        @foreach($financialaids as $key => $f)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$f->financialinstrument->name}}</td>
                            <td>{{$f->remarks}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        @endisset
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <select name="financial_instrument[]" id="financial-aid-selector" class="form-control"
                                    onchange="changeplh()">
                                    <option value="">Please choose</option>
                                    @foreach($instruments as $n)
                                    <option value="{{$n->id}}">{{$n->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input id="financial-aid-placeholder" type="text" class="form-control" name="remarks[]""></td>
                                    <td class="
                                    text-center"><a id="+f+" class="btn btn-danger btn-sm remove-financial text-white"><i
                                        class="fe fe-trash"></i>
                                    Delete</a></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">
    $(function () {
        var counter = 2;

        $("#add-financial").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>' + counter + '</td>';
            cols += '<td>';
            cols +=
                '<select name="financial_instrument[]" id="" class="form-control">';
            cols += '<option value="">Please choose</option>';
            cols +=
                '@foreach($instruments as $n)<option value="{{$n->id}}">{{$n->name}}</option>@endforeach</select></td>';
            cols += '<td><input type="text" class="form-control" name="remarks[]" />';
            cols += '</td>';
            cols +=
                '<td class="text-center"><a class="btn btn-danger btn-sm ibtnDel text-white"><i class="fe fe-trash"></i>Delete</a></td>';
            newRow.append(cols);
            $("table.financial-aid").append(newRow);
            counter++;
        });

        $("table.financial-aid").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });

    });

</script>
@endsection
