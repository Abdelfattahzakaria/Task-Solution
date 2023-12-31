@extends('layouts.master')
@section('css')

@section('title')
{{trans('grades_list.title')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('main_trans.Grades')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('main_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.Grades_list')}}</li>
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
                    {{trans('grades_list.add_grade')}}
                </button>
                <br><br>
                <!-- display || update || delete-->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('grades_list.name')}}</th>
                                <th>{{trans('grades_list.notes')}}</th>
                                <th>{{trans('grades_list.operations')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($grades as $grade)
                            <?php $i += 1; ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td><?php
                                    $field = null;
                                    Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
                                    ?>
                                    {{$grade->$field}}
                                </td>
                                <td>{{$grade->notes}}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{$grade->id}}" title="{{trans('grades_list.edit')}}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$grade->id}}" title="{{trans('grades_list.delete')}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{trans('grades_list.edit_grade')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('gradeUpdate')}}" method="post">
                                                @csrf
                                                @method("POST")
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2">{{trans('grades_list.grade_name_ar')}}
                                                            :</label>
                                                        <input id="Name" type="text" name="Name" class="form-control" value="{{$grade->name_ar}}" required>
                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{$grade->id}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{trans('grades_list.grade_name_en')}}
                                                            :</label>
                                                        <input type="text" class="form-control" value="{{$grade->name_en}}" name="Name_en" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">{{trans('grades_list.grade_notes')}}
                                                        :</label>
                                                    <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{$grade->notes}}</textarea>
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
                            <div class="modal fade" id="delete{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{trans('grades_list.delet_grade')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('deleteGrade')}}" method="post">
                                                @csrf
                                                @method("POST")
                                                {{trans('grades_list.warning_grade')}}
                                                <input type="text" class="form-control" value="{{$grade->$field}}">
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$grade->id}}">
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
                            </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{trans('grades_list.add_grade')}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <!-- add_form -->
                    <form action="{{route('Gradestore')}}" method="post">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{trans('grades_list.grade_name_ar')}}
                                    :</label>
                                <input id="Name" type="text" name="Name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{trans('grades_list.grade_name_en')}}
                                    :</label>
                                <input type="text" class="form-control" name="Name_en">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{trans('grades_list.grade_notes')}}
                                :</label>
                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('grades_list.cancel')}}</button>
                    <button type="submit" class="btn btn-success">{{trans('grades_list.submit_add_grade')}}</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div> 
<!-- row closed -->
@endsection
@section('js')

@endsection 