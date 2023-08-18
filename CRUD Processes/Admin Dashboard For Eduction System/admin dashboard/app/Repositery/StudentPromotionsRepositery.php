<?php

namespace App\Repositery;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class StudentPromotionsRepositery implements StudentPromotionsInterface
{
    public function student_promotions_index()
    {
        $Grades = Grade::all();
        return View("Students/promotions", compact("Grades"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function student_store_prpomotion($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $students = Student::where("grade_id", $request->Grade_id)->where("classroom_id", $request->Classroom_id)->where("section_id", $request->section_id)->where("academic_year", $request->old_academic_year)->get();
            //return $students;   
            foreach ($students as $student) :
                $stu = Student::findorFail($student->id);
                $stu->grade_id = $request->Grade_id_new;
                $stu->classroom_id = $request->Classroom_id_new;
                $stu->section_id = $request->section_id_new;
                $stu->academic_year = $request->old_academic_year;
                $stu->save();
                Promotion::updateOrCreate([
                    "student_id" => $student->id,
                    "from_grade" => $request->Grade_id,
                    "from_Classroom" => $request->Classroom_id,
                    "from_section" => $request->section_id,
                    "to_grade" => $request->Grade_id_new,
                    "to_Classroom" => $request->Classroom_id_new,
                    "to_section" => $request->section_id_new,
                    "old_academic_year" => $request->old_academic_year,
                    "new_academic_year" => $request->new_academic_year,
                ]);
            endforeach;
            DB::commit();
            return redirect()->route("studentList");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function display_students_promotion()
    {
        try {
            $promotions = Promotion::all();
            return View("Students/promotion/management", compact("promotions"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function delete_all_studentds_promotions($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            if ($request->page_id == 1) {
                $promotions = Promotion::all();
                //return $promotions;
                foreach ($promotions as $promotion) :
                    $stu = Student::findorFail($promotion->student_id);
                    $stu->grade_id = $promotion->from_grade;
                    $stu->classroom_id = $promotion->from_Classroom;
                    $stu->section_id = $promotion->from_section;
                    $stu->academic_year = $promotion->old_academic_year;
                    $stu->save();
                endforeach;
                Promotion::truncate();
                DB::commit();
            } else {
                //return $request;
                $promotion = Promotion::findorFail($request->id);
                $stu = Student::findorFail($promotion->student_id);
                $stu->grade_id = $promotion->from_grade;
                $stu->classroom_id = $promotion->from_Classroom;
                $stu->section_id = $promotion->from_section;
                $stu->academic_year = $promotion->old_academic_year;
                $stu->save();
                Promotion::destroy($promotion->id);
                DB::commit();
            }     
            return redirect()->route("promotionsDisplay"); 
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }  
}   
