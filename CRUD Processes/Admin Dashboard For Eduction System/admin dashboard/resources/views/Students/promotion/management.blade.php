<?php
$field = null;
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
?>
@extends('layouts.master')
@section('css')
@section('title')
{{trans('main_trans.students_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.students_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                تراجع الكل
                            </button>
                            <br><br>


                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">المرحلة الدراسية السابقة</th>
                                            <th class="alert-danger">السنة الدراسية</th>
                                            <th class="alert-danger">الصف الدراسي السابق</th>
                                            <th class="alert-danger">القسم الدراسي السابق</th>
                                            <th class="alert-success">المرحلة الدراسية الحالي</th>
                                            <th class="alert-success">السنة الدراسية الحالية</th>
                                            <th class="alert-success">الصف الدراسي الحالي</th>
                                            <th class="alert-success">القسم الدراسي الحالي</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($promotions as $promotion)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$promotion->student->$field}}</td>
                                            <td>{{$promotion->f_grade->$field}}</td>
                                            <td>{{$promotion->old_academic_year}}</td>
                                            <td>{{$promotion->f_classroom->$field}}</td>
                                            <td>{{$promotion->f_section->$field}}</td>
                                            <td>{{$promotion->t_grade->$field}}</td>
                                            <td>{{$promotion->new_academic_year}}</td>
                                            <td>{{$promotion->t_classroom->$field}}</td>
                                            <td>{{$promotion->t_section->$field}}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">ارجاع الطالب</button>
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button>
                                            </td>
                                        </tr>
                                        @include("Students/promotion/Delete_all")
                                        @include("Students/promotion/Delete_one") 
                                        @endforeach
                                </table>
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
@endsection