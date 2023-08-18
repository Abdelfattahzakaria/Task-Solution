<?php

namespace App\Repositery;

use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;

class QuizRepositery implements QuizRepositeryInterface
{
    public function index()
    {
        try {
            $quizzes = Quiz::all();
            return View("Quizzes/index", compact("quizzes"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function create()
    {
        try {
            $data["subjects"] = Subject::all();
            $data["teachers"] = Teacher::all();
            $data["grades"] = Grade::all();
            return View("Quizzes/create", $data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function store($request)
    {
        //return $request;
        try {
            $quizNewRecord = new Quiz();
            $quizNewRecord->name_ar = $request->Name_ar;
            $quizNewRecord->name_en = $request->Name_en;
            $quizNewRecord->subject_id = $request->subject_id;
            $quizNewRecord->grade_id = $request->Grade_id;
            $quizNewRecord->classroom_id = $request->Classroom_id;
            $quizNewRecord->teacher_id  = $request->teacher_id;
            $quizNewRecord->section_id = $request->section_id;
            $quizNewRecord->save();
            return redirect()->route("quizIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function edit($id)
    {
        //return $id;
        try {
            $quizz = Quiz::findorFail($id);
            $data["subjects"] = Subject::all();
            $data["teachers"] = Teacher::all();
            $data["grades"] = Grade::all();
            return View("Quizzes/edit", $data, compact("quizz"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function update($request)
    {
        //return $request;
        try {
            $quizNewRecord = Quiz::findorFail($request->id);
            $quizNewRecord->name_ar = $request->Name_ar;
            $quizNewRecord->name_en = $request->Name_en;
            $quizNewRecord->subject_id = $request->subject_id;
            $quizNewRecord->grade_id = $request->Grade_id;
            $quizNewRecord->classroom_id = $request->Classroom_id;
            $quizNewRecord->teacher_id  = $request->teacher_id;
            $quizNewRecord->section_id = $request->section_id;
            $quizNewRecord->save();
            return redirect()->route("quizIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function delete($request)
    {
        //return $request;
        try {
            Quiz::destroy($request->id);
            return redirect()->route("quizIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
} 
 