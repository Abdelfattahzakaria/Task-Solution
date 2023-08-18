<?php

namespace App\Repositery;

use App\Models\Fee;
use App\Models\Grade;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;

class FeesRepositery implements FeesRepositeryInterface
{
    public function fees_index()
    {
        try {
            $fees = Fee::all();
            return View("Fees/index", compact("fees"));
        } catch (\Exception $e) {
            return redirect()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function fees_add()
    {
        try {
            $Grades = Grade::all();
            return View("Fees/add", compact("Grades"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function fees_store($request)
    {
        //return $request;
        try {
            $feeNewRecord = new Fee();
            $feeNewRecord->title_ar = $request->title_ar;
            $feeNewRecord->title_en = $request->title_en;
            $feeNewRecord->amount = $request->amount;
            $feeNewRecord->grade_id = $request->Grade_id;
            $feeNewRecord->classroom_id = $request->Classroom_id;
            $feeNewRecord->description = $request->description;
            $feeNewRecord->year = $request->year;
            $feeNewRecord->Fee_type= $request->Fee_type; 
            $feeNewRecord->save();
            return redirect()->route("feesIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function fees_edit($id)
    {
        //return $id;
        try {
            //$fee = Fee::where("id", $id)->get();
            //return $fee;  
            $fee = Fee::findorFail($id);
            //return $fee;  
            $Grades = Grade::all();
            return View("Fees/edit", compact("fee", "Grades"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function fees_update($request)
    {
        //return $request;
        try {
            $feeNewRecord = Fee::findorFail($request->id);
            $feeNewRecord->title_ar = $request->title_ar;
            $feeNewRecord->title_en = $request->title_en;
            $feeNewRecord->amount = $request->amount;
            $feeNewRecord->grade_id = $request->Grade_id;
            $feeNewRecord->classroom_id = $request->Classroom_id;
            $feeNewRecord->description = $request->description;
            $feeNewRecord->year = $request->year;
            $feeNewRecord->save(); 
            return redirect()->route("feesIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function fees_delete($request)
    {
        //return $request; 
        try {
            Fee::destroy($request->id);  
            return redirect()->route("feesIndex");    
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
} 
