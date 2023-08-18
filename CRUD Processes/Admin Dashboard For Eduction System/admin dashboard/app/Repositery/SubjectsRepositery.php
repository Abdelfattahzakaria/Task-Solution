<?php

namespace App\Repositery;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;

class SubjectsRepositery implements SubjectsRepositeryInterface
{
    public function subjects_index()
    {
        try {
            $subjects = Subject::all();
            return View("Subjects/index", compact("subjects"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjects_create()
    {
        try {
            $grades = Grade::all();
            $teachers = Teacher::all();
            return View("Subjects/create", compact("grades", "teachers"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjects_store($request)
    {
        //return $request; 
        try {
            $records = Subject::where("grade_id", $request->Grade_id)->get();
            foreach ($records as $record) :
                if (($record->classroom_id == $request->Class_id) &&
                    ($record->name_ar == $request->Name_ar || $record->name_en == $request->Name_en)
                )
                    return redirect()->back()->withErrors(["error" => "this subject already exists!"]);
            endforeach;
            $subjectNewRecord = new Subject();
            $subjectNewRecord->name_ar = $request->Name_ar;
            $subjectNewRecord->name_en = $request->Name_en;
            $subjectNewRecord->grade_id = $request->Grade_id;
            $subjectNewRecord->classroom_id = $request->Class_id;
            $subjectNewRecord->teacher_id = $request->teacher_id;
            $subjectNewRecord->save();
            return redirect()->route("subjectsIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjects_edit($id)
    {
        //return $id; 
        try {
            $subject = Subject::findorFail($id);
            $grades = Grade::all();
            $teachers = Teacher::all();
            return View("Subjects/edit", compact("subject", "grades", "teachers"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subject_update($request)
    {
        //return $request; 
        try {
            $records = Subject::where("grade_id", $request->Grade_id)->get();
            foreach ($records as $record) :
                if (($record->classroom_id == $request->Class_id) &&
                    ($record->name_ar == $request->Name_ar || $record->name_en == $request->Name_en)
                )
                    return redirect()->back()->withErrors(["error" => "this subject already exists!"]);
            endforeach;
            $subjectNewRecord = Subject::findorFail($request->id); 
            $subjectNewRecord->name_ar = $request->Name_ar;
            $subjectNewRecord->name_en = $request->Name_en;
            $subjectNewRecord->grade_id = $request->Grade_id;
            $subjectNewRecord->classroom_id = $request->Class_id;
            $subjectNewRecord->teacher_id = $request->teacher_id;
            $subjectNewRecord->save();  
            return redirect()->route("subjectsIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subject_delete($request){
        //return $request;
         try{
            Subject::destroy($request->id); 
            return redirect()->route("subjectsIndex");    
         }catch(\Exception $e){
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
         }  
    }
}
      