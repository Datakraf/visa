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

<!-- Page CSS -->
@section('page-css')
@include('asset-partials.dropzone.css.file')
<link rel="stylesheet" href="{{asset('vendor/flag-icon-css-3/css/flag-icon.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/select2.bootstrap4.min.css')}}">

<style>
    .participants {
        display: none;
    }
</style>
@endsection
<!-- Page JS -->
@section('page-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var selector = function (dateStr) {
            var d1 = $('.event-from').datepicker('getDate');
            var d2 = $('.event-to').datepicker('getDate');
            var diff = 1;
            if (d1 && d2) {
                diff = diff + Math.floor((d2.getTime() - d1.getTime()) / 86400000);
            }
            $('.calculated').val(diff);
        }
        // Event
        $(".event-from").datepicker({
            dateFormat: "{{config('app.date_format_js')}}",
            changeMonth: true,
            numberOfMonths: 1,
            minDate: 0,
            onClose: function (selectedDate) {
                $(".event-to").datepicker("option", "minDate", selectedDate);
            }
        });
        $(".event-to").datepicker({
            defaultDate: "+1w",
            dateFormat: "{{config('app.date_format_js')}}",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $(".event-from").datepicker("option", "maxDate", selectedDate);
            }
        });
        $(".event-from,.event-to").change(selector);
        // Tavel
        $(".travel-from").datepicker({
            defaultDate: "+1w",
            dateFormat: "{{config('app.date_format_js')}}",
            changeMonth: true,
            numberOfMonths: 1,
            minDate: 0,
            onClose: function (selectedDate) {
                $(".event-from").datepicker("option", "minDate", selectedDate);
                $(".travel-to").datepicker("option", "minDate", selectedDate);
            }
        });
        $(".travel-to").datepicker({
            defaultDate: "+1w",
            dateFormat: "{{config('app.date_format_js')}}",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $(".event-to").datepicker("option", "maxDate", selectedDate);
                $(".event-from").datepicker("option", "maxDate", selectedDate);
                $(".travel-from").datepicker("option", "maxDate", selectedDate);
            }
        });


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

        $(function () {
            var counter = 2;

            $("#add-participant").on("click", function () {
                $('.students').select2('destroy');

                var newRow = $("<tr>");
                var cols = "";
                cols += '<td>' + counter + '</td>';
                cols += '<td>';
                cols +=
                    '<select name="matric_num[]" id="" class="form-control students">';
                cols += '</td>';
                cols +=
                    '<td class="text-center"><a class="btn btn-danger btn-sm ibtnDel text-white"><i class="fe fe-trash"></i>Delete</a></td>';
                newRow.append(cols);
                $("table.participants").append(newRow);
                counter++;

                $('.students').select2({
                    placeholder: 'Please Select',
                    theme: 'bootstrap4',
                    width: '100%',
                    ajax: {
                        url: "{{route('participant.search')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id,

                                    }
                                })
                            };
                        },
                        cache: true,
                        allowClear: true
                    }
                });

            });

            $("table.participants").on("click", ".ibtnDel", function (event) {
                $(this).closest("tr").remove();
                counter -= 1
            });

        });

        $(function () {

            $('.num_participants').change(function () {

                var selected_option = $('.num_participants').val();

                if (selected_option == 1 || selected_option == 0) {
                    $('.participants').hide();
                }
                if (selected_option == 2) {
                    $('.participants').show();
                }
            });
        });

        $(function () {
            $('.college-fellow').hide();
            $('.immediate-supervisor').hide();

            $('.application_type').change(function () {

                var selected_option = $('.application_type').val();
                if (selected_option == '') {
                    $('.college-fellow').hide();
                    $('.immediate-supervisor').hide();
                }
                if (selected_option == 'faculty') {
                    $('.college-fellow').hide();
                    $('.immediate-supervisor').show();
                }
                if (selected_option == 'college') {
                    $('.immediate-supervisor').hide();
                    $('.college-fellow').show();
                }
            });
        });

        $(function () {

            $('.supervisor').select2({
                placeholder: 'Please Select',
                theme: 'bootstrap4',
                width: '100%',
                ajax: {
                    url: "{{route('supervisor.search')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,

                                }
                            })
                        };
                    },
                    cache: true,
                    allowClear: true
                }
            });

            $('.college_fellow').select2({
                placeholder: 'Please Select',
                theme: 'bootstrap4',
                width: '100%',
                ajax: {
                    url: "{{route('college.search')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,

                                }
                            })
                        };
                    },
                    cache: true,
                    allowClear: true
                }
            });

            $('.students').select2({
                placeholder: 'Please Select',
                theme: 'bootstrap4',
                width: '100%',
                ajax: {
                    url: "{{route('participant.search')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,

                                }
                            })
                        };
                    },
                    cache: true,
                    allowClear: true
                }
            });
        });
    });

</script>
<script>
    function changeplh() {
        var sel = document.getElementById("financial-aid-selector");
        var textbx = document.getElementById("financial-aid-placeholder");
        var indexe = sel.selectedIndex;

        if (indexe == 1) {
            $("#financial-aid-placeholder").attr("placeholder", "Account Number");

        }
        if (indexe == 2) {
            $("#financial-aid-placeholder").attr("placeholder", "Account Number");
        }
        if (indexe == 3) {
            $("#financial-aid-placeholder").attr("placeholder", "Account Number");
        }
        if (indexe == 4) {
            $("#financial-aid-placeholder").attr("placeholder", "Name of Sponsor");
        }
        if (indexe == 5) {
            $("#financial-aid-placeholder").attr("placeholder", "Please specify");
        }
    }

</script>
@endsection
