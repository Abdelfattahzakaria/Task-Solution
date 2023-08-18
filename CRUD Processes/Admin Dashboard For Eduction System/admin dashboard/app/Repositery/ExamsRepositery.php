<?php

namespace App\Repositery;

use App\Models\Exam;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Route;

class ExamsRepositery implements ExamsRepositeryInterface
{
    public function exam_index()
    {
        try {
            $exams = Exam::all();
            return View("Exams/index", compact("exams"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function exam_create()
    {
        try {
            return View("Exams/create");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function exam_store($request)
    {
        //return $request; 
        try {
            $checkOut = Exam::where("academic_year", $request->academic_year)->where("term", $request->term)->where("name_ar", $request->Name_ar)->where("name_en", $request->Name_en)->get();
            if ($checkOut->count() != 0)
                return redirect()->back()->withErrors(["error" => "this exam already exists"]);
            $examNewRecord = new Exam();
            $examNewRecord->name_ar = $request->Name_ar;
            $examNewRecord->name_en = $request->Name_en;
            $examNewRecord->term = $request->term;
            $examNewRecord->academic_year = $request->academic_year;
            $examNewRecord->save();
            return redirect()->route("examsIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function exam_edit($id)
    {
        //return $id; 
        try {
            $exam = Exam::findorFail($id);
            return View("Exams/edit", compact("exam"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function exam_update($request)
    {
        //return $request; 
        try {
            $checkOut = Exam::where("academic_year", $request->academic_year)->where("term", $request->term)->where("name_ar", $request->Name_ar)->where("name_en", $request->Name_en)->get();
            if ($checkOut->count() != 0)
                return redirect()->back()->withErrors(["error" => "this exam already exists"]);
            $examNewRecord = Exam::findorFail($request->id);
            $examNewRecord->name_ar = $request->Name_ar;
            $examNewRecord->name_en = $request->Name_en;
            $examNewRecord->term = $request->term;
            $examNewRecord->academic_year = $request->academic_year;
            $examNewRecord->save();
            return redirect()->route("examsIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function exam_delete($request)
    {
        //return $request; 
        try {
            Exam::destroy($request->id);
            return redirect()->route("examsIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
} 
