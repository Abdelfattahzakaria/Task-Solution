<?php

use PhpParser\Node\Stmt\Label;

$Field = null;
$field = null;
$father_name = null;
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $Field = "Name_Ar" : $Field = "Name_En";
Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() === "ar" ? $father_name = "Name_Father_Ar" : $father_name = "Name_Father_En";
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
                            <a href="{{route('createStudent')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">{{trans('main_trans.add_students')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$student->$field}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender->$Field}}</td>
                                            <td>{{$student->grade->$field}}</td>
                                            <td>{{$student->classroom->$field}}</td>
                                            <td>{{$student->section->$field}}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        العمليات
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{route('showStudentDetails',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp; عرض بيانات الطالب</a>
                                                        <a class="dropdown-item" href="{{route('studentEdit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp; تعديل بيانات الطالب</a>
                                                        <a class="dropdown-item" href="{{route('feesInvoicesAdd',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                                                        <a class="dropdown-item" href="{{route('studentAddReciept',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; &nbsp;سند قبض</a>
                                                        <a class="dropdown-item" href="{{route('processingFeesAdd',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; &nbsp;استبعاد رسوم</a>
                                                        <a class="dropdown-item" href="{{route('paymentStudentAdd',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; &nbsp;سند صرف</a>
                                                        <a class="dropdown-item" data-target="#" data-toggle="modal" href="##Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp; حذف بيانات الطالب</a>
                                                    </div>  
                                                </div>
                                            </td>   
                                        </tr>  
                                        @include('Students.Delete')
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