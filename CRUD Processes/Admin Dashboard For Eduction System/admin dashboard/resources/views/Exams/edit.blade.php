@extends('layouts.master')
@section('css')
@section('title')
    تعديل امتحان
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الامتحانات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">الرئسية</a></li>
                <li class="breadcrumb-item active">تعديل امتحان</li>
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

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif 
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                                <form action="{{route('examUpdate')}}" method="post">
                                @csrf
                                @method("POST")
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">اسم الامتحان باللغة العربية</label>
                                        <input type="text" name="Name_ar" value="{{ $exam->name_ar}}" class="form-control">
                                        <input type="hidden" name="id" value="{{$exam->id}}">
                                    </div>

                                    <div class="col">
                                        <label for="title">اسم الامتحان باللغة الانجليزية</label>
                                        <input type="text" name="Name_en" value="{{ $exam->name_en}}" class="form-control">
                                    </div>
  
                                    <div class="col">
                                        <label for="title">الترم</label>
                                        <input type="number" name="term" value="{{$exam->term}}" class="form-control">
                                    </div>
  
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                <option value="{{$year}}" {{$year == $exam->academic_year ?'selected':''}}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ البيانات</button>
                            </form>
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
