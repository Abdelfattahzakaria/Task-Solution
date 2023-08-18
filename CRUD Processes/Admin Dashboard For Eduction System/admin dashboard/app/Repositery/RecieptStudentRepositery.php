<?php

namespace App\Repositery;

use App\Models\Foundstudent;
use App\Models\Receiptstudent;
use App\Models\Student;
use App\Models\Studentsaccounting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class RecieptStudentRepositery implements RecieptStudentRepositeryInterface
{
    public function student_index_reciept()
    {
        try {
            $receipt_students = Receiptstudent::all();
            return View("Receipt/index", compact("receipt_students"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function student_add_reciept($id)
    {
        try {
            $student = Student::findorFail($id);
            return View("Receipt/add", compact("student"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function student_store_reciept($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $recieptStu = new Receiptstudent();
            $recieptStu->date = date("y-m-d");
            $recieptStu->student_id = $request->student_id;
            $recieptStu->Debit = $request->Debit;
            $recieptStu->description = $request->description;
            $recieptStu->save();

            $fundStu = new Foundstudent();
            $fundStu->date = date("y-m-d");
            $fundStu->receiptstudent_id = $recieptStu->id;
            $fundStu->Debit = $request->Debit;
            $fundStu->credit = 0.000;
            $fundStu->description = $request->description;
            $fundStu->save();

            $stuAccounting = new Studentsaccounting();
            $stuAccounting->student_id = $request->student_id;
            $stuAccounting->Debit = 0.000;
            $stuAccounting->credit = $request->Debit;
            $stuAccounting->description = $request->description;
            $stuAccounting->type = "reciept";
            $stuAccounting->receiptstudent_id = $recieptStu->id;
            $stuAccounting->save();
            DB::commit();
            return redirect()->route("studentRecieptIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function student_edit_reciet($id)
    {
        try {
            $receipt_student = Receiptstudent::findorFail($id);
            return View("Receipt/edit", compact("receipt_student"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function student_update_reciept($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $recieptStu = Receiptstudent::findorFail($request->id);
            $recieptStu->date = date("y-m-d");
            $recieptStu->student_id = $request->student_id;
            $recieptStu->Debit = $request->Debit;
            $recieptStu->description = $request->description;
            $recieptStu->save();

            $fundStu = Foundstudent::where("receiptstudent_id", $recieptStu->id)->first();
            $fundStu->date = date("y-m-d");
            $fundStu->receiptstudent_id = $recieptStu->id;
            $fundStu->Debit = $request->Debit;
            $fundStu->credit = 0.000;
            $fundStu->description = $request->description;
            $fundStu->save();

            $stuAccounting = Studentsaccounting::where("receiptstudent_id", $request->id)->first();
            $stuAccounting->student_id = $request->student_id;
            $stuAccounting->Debit = 0.000;
            $stuAccounting->credit = $request->Debit;
            $stuAccounting->description = $request->description;
            $stuAccounting->type = "reciept";
            $stuAccounting->receiptstudent_id = $recieptStu->id;
            $stuAccounting->save();
            DB::commit();
            return redirect()->route("studentRecieptIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function student_delete_reciept($request){ 
        //return $request;
        try{
            Receiptstudent::destroy($request->id);  
            return redirect()->route("studentRecieptIndex");
        }catch(\Exception $e){
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
}
    