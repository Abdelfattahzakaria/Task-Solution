<?php
$field = null;
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
?>
@if(isset($searchData))
  <?php $classroomsList= $searchData?> 
@else
  <?php $classroomsList= $classrooms?>     
@endif 
@extends('layouts.master')
@section('css')
@section('title')
{{trans('main_trans.classroomslist')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('main_trans.classrooms')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.classroomslist')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{trans('classroom_list.add_classroom')}}
                </button>
                <button type="button" class="button x-small" id="btn_delete_all">
                    {{trans('classroom_list.delete_checkbox')}}
                </button>
                <br><br>
                <!--Search_By_Grade-->
                <form action="{{route('classroomSearch')}}" method="post">
                    @csrf
                    @method("POST") 
                    <select style="margin:15px;" class="selectpicker" data-style="btn-info" name="Grade_id" required onchange="this.form.submit()">
                        <option style="cursor:pointer;" value="" selected disabled>{{trans('classroom_list.Search_By_Grade')}}</option>
                        @foreach($grades as $Grade)
                        <option style="cursor:pointer;" value="{{$Grade->id}}">{{$Grade->$field}}</option>     
                        @endforeach        
                    </select>  
                </form>
                <!-- display || update || delete-->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th>#</th>
                                <th>{{trans('classroom_list.name')}}</th>
                                <th>{{trans('classroom_list.grade')}}</th>
                                <th>{{trans('classroom_list.operations')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?> 
                            @foreach($classroomsList as $classroom)
                            <?php $i += 1 ?>
                            <tr>
                                <td><input type="checkbox" value="{{$classroom->id}}" class="box1"></td>
                                <td>{{$i}}</td>
                                <td>{{$classroom->$field}}</td>
                                <td>
                                    {{$classroom->grade->$field}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$classroom->id}}" title="{{trans('classroom_list.edit')}}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$classroom->id}}" title="{{trans('classroom_list.delete')}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{$classroom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{trans('classroom_list.edit_classroom')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{route('classroomUpdate')}}" method="post">
                                                @csrf
                                                @method("POST")
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2">{{trans('classroom_list.class_ar_name')}}:</label>
                                                        <input id="Name" type="text" name="Name" class="form-control" value="{{$classroom->name_ar}}">
                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{$classroom->id}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{trans('classroom_list.class_en_name')}}
                                                            :</label>
                                                        <input type="text" class="form-control" value="{{$classroom->name_en}}" name="Name_en">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{trans('classroom_list.grade_name')}}
                                                        :</label>
                                                    <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="Grade_id">
                                                        <option value="{{$classroom->grade->id}}">
                                                            {{$classroom->grade->$field}}
                                                        </option>
                                                        @foreach ($grades as $grade)
                                                        <option value="{{$grade->id}}">
                                                            {{$grade->$field}}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_list.cancel')}}</button>
                                                    <button type="submit" class="btn btn-success">{{trans('grades_list.submit_edit_grade')}}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{$classroom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{trans('classroom_list.delete_classroom')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('deleteClassroom')}}" method="post">
                                                @method("POST")
                                                @csrf
                                                {{trans('classroom_list.warning_delete_classroom')}}
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$classroom->id}}">
                                                <input id="id" type="text" class="form-control" value="{{$classroom->$field}}" disabled>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_class -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{trans('classroom_list.add_class')}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{route('Classstore')}}" method="post">
                        @csrf
                        @method("POST")
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{trans('classroom_list.class_ar_name')}}
                                                    :</label>
                                                <input class="form-control" type="text" name="Name" />
                                            </div>


                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{trans('classroom_list.class_en_name')}}
                                                    :</label>
                                                <input class="form-control" type="text" name="Name_class_en" />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{trans('classroom_list.grade_name')}}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="Grade_id">
                                                        @foreach ($grades as $grade)
                                                        <option value="{{$grade->id }}">{{$grade->$field}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{trans('classroom_list.processes')}}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{trans('classroom_list.delete_row')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{trans('classroom_list.add_class')}}" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('classroom_list.close')}}</button>
                                    <button type="submit" class="btn btn-success">{{trans('classroom_list.submit')}}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>
    <!-- حذف مجموعة صفوف -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{trans('classroom_list.delete_class')}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('deleteAllSelectedClassrooms')}}" method="post">
                    @csrf
                    @method("POST")
                    <div class="modal-body">
                        {{trans('classroom_list.delete_warning')}}<br />
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_list.cancel')}}</button>
                        <button type="submit" class="btn btn-danger">{{trans('grades_list.submit_delete_grade')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>
@endsection