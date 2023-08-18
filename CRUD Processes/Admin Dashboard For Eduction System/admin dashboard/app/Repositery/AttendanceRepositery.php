<?php

namespace App\Repositery;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Contracts\View\View;

class AttendanceRepositery implements AttendanceRepositeryInterface
{
    public function attendance_gradesList()
    {
        try {
            $Grades = Grade::with(["sections"])->get();
            return View("Attendance/Sections", compact("Grades"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function attendance_add($section_id)
    {
        //return $section_id; 
        try {
            $students= Student::where("section_id",$section_id)->get();  
            //return $students; 
            return View("Attendance/index",compact("students"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function attendance_store($request)
    {   
        //return $request; 
        try{
            foreach($request->attendences as $studentID=>$attendance): 
                $studentAttendanceRecord= new Attendance(); 
                $studentAttendanceRecord->student_id= $studentID; 
                $studentAttendanceRecord->grade_id= $request->grade_id; 
                $studentAttendanceRecord->classroom_id = $request->classroom_id; 
                $studentAttendanceRecord->section_id = $request->section_id;  
                $studentAttendanceRecord->teacher_id = 1; 
                $studentAttendanceRecord->attendence_date = date("y-m-d");   
                $studentAttendanceRecord->attendence_status = $attendance=="presence"?1:0;  
                $studentAttendanceRecord->save();  
            endforeach;   
            return redirect()->back();  
        }catch(\Exception $e){
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }    
}     
         