<?php

namespace App\Http\Controllers;

use App\Repositery\AttendanceRepositeryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $Attendance;
    public function __construct(AttendanceRepositeryInterface $Attendance)
    {
        $this->Attendance = $Attendance;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function attendanceGradesList(){
        return $this->Attendance->attendance_gradesList();  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------- ------------------------------------------------------------------------------
    public function attendanceAdd($id){  
        return $this->Attendance->attendance_add($id); 
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function attendanceStore(Request $request){
        return $this->Attendance->attendance_store($request);  
    }
}
   