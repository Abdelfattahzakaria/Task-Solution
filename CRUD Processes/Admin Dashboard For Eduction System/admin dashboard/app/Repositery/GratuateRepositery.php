<?php

namespace App\Repositery;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use PHPUnit\Framework\MockObject\Builder\Stub;

class GratuateRepositery implements GraduateRepositeryInterface
{
    public function create_graduate()
    {
        $Grades = Grade::all();
        return View("Students/Graduated/create", compact("Grades"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduate_soft_deletes($request)
    {
        //return $request;    
        try {
            $students = Student::where("grade_id", $request->Grade_id)->where("classroom_id", $request->Classroom_id)->where("section_id", $request->section_id)->get();
            //return $students;
            if ($students) {
                foreach ($students as $student) :
                    Student::where("id", $student->id)->delete();
                endforeach;
                return redirect()->route("graduateIndex");
            }
            return redirect()->back()->with("error_Graduated", __("there are no students found"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduate_index()
    {
        $students = Student::onlyTrashed()->get();
        return View("Students/Graduated/index", compact("students"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduate_restore($request)
    {
        try {
            Student::onlyTrashed()->where("id",$request->id)->restore(); 
            return redirect()->route("graduateIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduate_delete($request)
    {
        try {
            Student::onlyTrashed()->where("id",$request->id)->forceDelete();  
            return redirect()->route("graduateIndex");   
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}
