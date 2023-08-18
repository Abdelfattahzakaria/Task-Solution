<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">الرئسية</span>
                            </div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>
                    <!--grades-->
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><span class="right-nav-text">{{trans('main_trans.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('gradesList')}}">{{trans('main_trans.Grades_list')}}</a></li>
                        </ul>
                    </li>
                    <!--classrooms-->
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><span class="right-nav-text">{{trans('main_trans.classrooms')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classroomList')}}">{{trans('main_trans.classroomslist')}}</a> </li>
                        </ul>
                    </li>
                    <!--sections-->
                    <li>
                        <a href="{{route('sections')}}"><span class="right-nav-text">{{trans('main_trans.sections')}}</span> </a>
                    </li>
                    <!-- students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"></i>{{trans('main_trans.students')}}
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students-menu" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main_trans.Student_information')}}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a href="{{route('createStudent')}}">{{trans('main_trans.add_students')}}</a> </li>
                                    <li> <a href="{{route('studentList')}}">{{trans('main_trans.students_list')}}</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('main_trans.students_promotions')}}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a href="{{route('index')}}">{{trans('main_trans.students_promotions')}}</a> </li>
                                    <li> <a href="{{route('promotionsDisplay')}}">{{trans('main_trans.students_promotions_managment')}}</a> </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('main_trans.Graduate_students')}}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="Graduate students" class="collapse">
                                    <li> <a href="{{route('createGraduate')}}">{{trans('main_trans.add_Graduate')}}</a> </li>
                                    <li> <a href="{{route('graduateIndex')}}">{{trans('main_trans.list_Graduate')}}</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- Teachers-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><span class="right-nav-text">{{trans('main_trans.Teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teachersList')}}">{{trans('main_trans.teachers_list')}}</a> </li>
                        </ul>
                    </li>
                    <!-- Parents-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                            <div class="pull-left"><span class="right-nav-text">{{trans('main_trans.Parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url('parentsInfo')}}">{{trans('main_trans.List_Parents')}}</a> </li>
                        </ul>
                    </li>
                    <!-- Accounts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                            <div class="pull-left"><span class="right-nav-text">{{trans('main_trans.Accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('feesIndex')}}">{{trans('main_trans.fees')}}</a> </li>
                            <li> <a href="{{route('feesInvoicesIndex')}}">{{trans('main_trans.feesInvoicesList')}}</a> </li>
                            <li> <a href="{{route('studentRecieptIndex')}}">سندات القبض</a> </li>
                            <li> <a href="{{route('processingFeesIndex')}}">استبعاد رسوم</a> </li>
                            <li> <a href="{{route('paymentStudentIndex')}}">سندت الصرف</a> </li>
                        </ul>
                    </li>
                    <!-- Attendance-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                            <div class="pull-left"><span class="right-nav-text">{{trans('main_trans.Attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attendanceGradesList')}}">قائمة الطلاب</a> </li>
                        </ul>
                    </li>
                    <!-- Subjects-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                            <div class="pull-left"><span class="right-nav-text">المواد الدراسية</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('subjectsIndex')}}">قائمة المواد</a> </li>
                        </ul>
                    </li>
                    <!--Exams-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon_">
                            <div class="pull-left"><span class="right-nav-text">الامتحانات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon_" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('examsIndex')}}">قائمة الامتحانات</a> </li>
                        </ul>
                    </li>
                    <!-- Quizzes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon__">
                            <div class="pull-left"><span class="right-nav-text">الاختبارات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon__" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('quizIndex')}}">قائمة الاختبارات</a> </li>
                            <li> <a href="{{route('questionsList')}}">قائمة الاسئلة</a> </li>
                        </ul>
                    </li>
                    <!-- library-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                            <div class="pull-left"><span class="right-nav-text">المكتبة</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('libraryIndex')}}">قائمة الكتب</a> </li>
                        </ul>
                    </li>
                    <!-- Settings-->
                    <li>
                        <a href="{{route('settingIndex')}}"><i class="fas fa-cogs"></i><span class="right-nav-text">الاعدادات</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================  