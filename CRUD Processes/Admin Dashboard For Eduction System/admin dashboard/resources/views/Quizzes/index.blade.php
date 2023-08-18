<?php
$field = null;
$Field = null;
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $Field = "Name_Ar" : $Field = "Name_En";
?>
@extends('layouts.master')
@section('css')
@section('title')
قائمة الاختبارات
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الاختبارت</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">الرئسية</a></li>
                <li class="breadcrumb-item active">قائمة الاختبارات</li>
            </ol>
        </div>
    </div>
</div>
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
                            <a href="{{route('quizCreate')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">اضافة اختبار جديد</a><br><br>
                            <div class="table-responsive">  
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                    <thead>   
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الاختبار</th>
                                            <th>اسم المعلم</th>
                                            <th>المرحلة الدراسية</th>
                                            <th>الصف الدراسي</th>
                                            <th>القسم</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quizzes as $quizze)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{$quizze->$field}}</td>
                                            <td>{{$quizze->teacher->$Field}}</td>
                                            <td>{{$quizze->grade->$field}}</td>
                                            <td>{{$quizze->classroom->$field}}</td> 
                                            <td>{{$quizze->section->$field}}</td>
                                            <td>
                                                <a href="{{route('quizEdit',$quizze->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_exam{{ $quizze->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                            </td>   
                                        </tr> 

                                        <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('quizDelete')}}" method="post">
                                                    @csrf
                                                    @method("POST")  
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف اختبار</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('classroom_list.warning_delete_classroom') }} <br /> {{$quizze->$field}}</p>
                                                            <input type="hidden" name="id" value="{{$quizze->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades_list.cancel')}}</button>
                                                                <button type="submit" class="btn btn-danger">{{ trans('grades_list.submit_delete_grade')}}</button>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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