<?php
use PhpParser\Node\Stmt\Label;
$field = null;
$Field = null;
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $Field = "Name_Ar" : $Field = "Name_En";
?>
@extends('layouts.master')
@section('css')
@section('title')
{{trans("section.title")}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans("section.title")}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{trans("section.add_section")}}
                </a>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">
                        @foreach($grades as $grade)
                        <div class="acd-group">
                            <a href="#" class="acd-heading">{{$grade->$field}}</a>
                            <div class="acd-des">

                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{trans("section.section_name")}}</th>
                                                                <th>{{trans("section.classroom_name")}}</th>
                                                                <th>{{trans("section.status")}}</th>
                                                                <th>{{trans("section.processes")}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach($grade->sections as $section)
                                                            <?php $i += 1; ?>
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{$section->$field}}</td>
                                                                <td>{{$section->classroom->$field}}</td>
                                                                <td>
                                                                    @if($section->status===1)
                                                                    <label class="badge badge-success">{{trans('section.Status_Section_AC')}}</label>
                                                                    @else
                                                                    <label class="badge badge-danger">{{trans('section.Status_Section_No')}}</label>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#edit{{$section->id}}">{{trans("grades_list.edit")}}</a>
                                                                    <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{$section->id}}">{{trans("grades_list.delete")}}</a>
                                                                </td>
                                                            </tr>
                                                            <!--تعديل قسم جديد -->
                                                            <div class="modal fade" id="edit{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                                                                {{trans('section.edit_Section')}}
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('sectionUpdate')}}" method="post">
                                                                                @csrf
                                                                                @method("POST")
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <input type="text" name="Name" class="form-control" value="{{$section->name_ar}}">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <input type="text" name="Name_en" class="form-control" value="{{$section->name_en}}">
                                                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{$section->id}}">
                                                                                    </div>

                                                                                </div>
                                                                                <br>
                                                                                <div class="col">
                                                                                    <label for="inputName" class="control-label">{{trans('section.section_grade_name')}}</label>
                                                                                    <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">
                                                                                        <!--placeholder-->
                                                                                        <option value="{{$grade->id}}">
                                                                                            {{$grade->$field}}
                                                                                        </option>
                                                                                        @foreach ($gradesList as $list_Grade)
                                                                                        <option value="{{$list_Grade->id}}">
                                                                                            {{$list_Grade->$field}}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <br>
                                                                                <div class="col">
                                                                                    <label for="inputName" class="control-label">{{trans('section.classroom_name')}}</label>
                                                                                    <select name="Class_id" class="custom-select">
                                                                                        <option value="{{$section->classroom->id}}">
                                                                                            {{$section->classroom->$field}}
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                <br>

                                                                                <div class="col">
                                                                                    <div class="form-check">

                                                                                        @if ($section->section===1)
                                                                                        <input type="checkbox" checked class="form-check-input" name="Status" id="exampleCheck1">
                                                                                        @else
                                                                                        <input type="checkbox" class="form-check-input" name="Status" id="exampleCheck1">
                                                                                        @endif
                                                                                        <label class="form-check-label" for="exampleCheck1">{{trans('section.Status')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label for="inputName" class="control-label">{{ trans('section.Name_Teacher') }}</label>
                                                                                    <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                                                        @foreach($section->teachers as $teacher)
                                                                                        <option selected value="{{$teacher['id']}}">{{$teacher->$Field}}</option>
                                                                                        @endforeach 

                                                                                        @foreach($teachers as $teacher)
                                                                                        <option value="{{$teacher->id}}">{{$teacher->$Field}}</option>
                                                                                        @endforeach
                                                                                    </select>  
                                                                                </div>   
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_list.cancel')}}</button>
                                                                            <button type="submit" class="btn btn-danger">{{trans('grades_list.submit_edit_grade')}}</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- delete_modal_Grade -->
                                                            <div class="modal fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                                {{trans('section.delete_Section')}}
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{route('deleteSection')}}" method="post">
                                                                                @csrf
                                                                                @method("POST")
                                                                                {{trans('section.Warning_Section')}}<br /><br />
                                                                                <input type="text" value="{{$section->$field}}"><br /><br />
                                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$section->id}}">
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_list.cancel')}}</button>
                                                                                    <button type="submit" class="btn btn-danger">{{trans('grades_list.submit_delete_grade')}}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--اضافة قسم جديد -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                    {{trans("section.add_section")}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{route('SectionStore')}}" method="post">
                                    @csrf
                                    @method("POST")
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="Name" class="form-control" placeholder="{{trans('section.section_ar_name')}}">
                                        </div>

                                        <div class="col">
                                            <input type="text" name="Name_en" class="form-control" placeholder="{{trans('section.section_en_name')}}">
                                        </div>

                                    </div>
                                    <br>


                                    <div class="col">
                                        <label for="inputName" class="control-label">{{trans('section.section_grade_name')}}</label>
                                        <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="" selected disabled>{{trans('section.section_select_grade_name')}}
                                            </option>
                                            @foreach ($gradesList as $list_Grade)
                                            <option value="{{$list_Grade->id}}"> {{$list_Grade->$field}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="inputName" class="control-label">{{trans('section.classroom_name')}}</label>
                                        <select name="Class_id" class="custom-select">

                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="inputName" class="control-label">{{ trans('section.Name_Teacher') }}</label>
                                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                            @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->$Field}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_list.cancel')}}</button>
                                <button type="submit" class="btn btn-danger">{{trans('grades_list.submit_add_grade')}}</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="Class_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
