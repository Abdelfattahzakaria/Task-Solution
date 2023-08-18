<?php

namespace App\Repositery;

use App\Models\Processingfee;
use App\Models\Student;
use App\Models\Studentsaccounting;
use Egulias\EmailValidator\Result\Reason\UnclosedComment;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class ProcessingFeesRepositery implements ProcessingFeesRepositeryInterface
{
    public function ProcessingFees_index()
    {
        $ProcessingFees = Processingfee::all();
        return View("ProcessingFee/index", compact("ProcessingFees"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function PrecessingFees_add($id)
    {
        //return $id;
        try {
            $student = Student::findorFail($id);
            return View("ProcessingFee/add", compact("student"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function ProcessingFees_store($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $preocessingFeesRecord = new Processingfee();
            $preocessingFeesRecord->date = date("y-m-d");
            $preocessingFeesRecord->student_id = $request->student_id;
            $preocessingFeesRecord->amount = $request->Debit;
            $preocessingFeesRecord->description = $request->description;
            $preocessingFeesRecord->save();

            $studentAccountingRecord = new Studentsaccounting();
            $studentAccountingRecord->student_id = $request->student_id;
            $studentAccountingRecord->Debit = 0.000;
            $studentAccountingRecord->credit = $request->Debit;
            $studentAccountingRecord->description = $request->description;
            $studentAccountingRecord->type = "processing fees";
            $studentAccountingRecord->processingfee_id = $preocessingFeesRecord->id;
            $studentAccountingRecord->save();
            DB::commit();
            return redirect()->route("processingFeesIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function ProcessingFees_edit($id)
    {
        //return $id;
        try {
            $ProcessingFee = Processingfee::findorFail($id);
            return View("ProcessingFee/edit", compact("ProcessingFee"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function ProcessingFees_delete($request)
    {
        //return $request;
        try {
            Processingfee::destroy($request->id); 
            return redirect()->route("processingFeesIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function ProcessingFees_update($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $preocessingFeesRecord = Processingfee::findorFail($request->id);
            $preocessingFeesRecord->date = date("y-m-d"); 
            $preocessingFeesRecord->student_id = $request->student_id;
            $preocessingFeesRecord->amount = $request->Debit;
            $preocessingFeesRecord->description = $request->description;
            $preocessingFeesRecord->save();  

            $studentAccountingRecord = Studentsaccounting::where("processingfee_id",$preocessingFeesRecord->id)->first();
            $studentAccountingRecord->student_id = $request->student_id;
            $studentAccountingRecord->Debit = 0.000; 
            $studentAccountingRecord->credit = $request->Debit;
            $studentAccountingRecord->description = $request->description;
            $studentAccountingRecord->type = "processing fees";
            $studentAccountingRecord->processingfee_id = $preocessingFeesRecord->id;
            $studentAccountingRecord->save();
            DB::commit();
            return redirect()->route("processingFeesIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
}
     