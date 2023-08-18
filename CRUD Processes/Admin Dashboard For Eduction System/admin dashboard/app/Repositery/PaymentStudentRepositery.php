<?php

namespace App\Repositery;

use App\Models\Foundstudent;
use App\Models\Paymentstudent;
use App\Models\Student;
use App\Models\Studentsaccounting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class PaymentStudentRepositery implements PaymentStudentRepositeryInterface
{
    public function paymentStudent_add($id)
    {
        $student = Student::findorFail($id);
        return View("Payment/add", compact("student"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudent_store($request)
    {
        //return $request;  
        DB::beginTransaction();
        try {
            $studentPayRecord = new Paymentstudent();
            $studentPayRecord->date = date("y-m-d");
            $studentPayRecord->amount = $request->Debit;
            $studentPayRecord->student_id = $request->student_id;
            $studentPayRecord->description = $request->description;
            $studentPayRecord->save();

            $fundStuRecord = new Foundstudent();
            $fundStuRecord->date = date("y-m-d");
            $fundStuRecord->paymentstudent_id = $studentPayRecord->id;
            $fundStuRecord->Debit = 0.000;
            $fundStuRecord->credit = $request->Debit;
            $fundStuRecord->description = $request->description;
            $fundStuRecord->save();

            $studentAccRecord = new Studentsaccounting();
            $studentAccRecord->student_id = $request->student_id;
            $studentAccRecord->Debit = $request->Debit;
            $studentAccRecord->credit = 0.000;
            $studentAccRecord->description = $request->description;
            $studentAccRecord->type = "student payment";
            $studentAccRecord->paymentstudent_id = $studentPayRecord->id;
            $studentAccRecord->save();
            DB::commit();
            return redirect()->route("paymentStudentIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudent_index()
    {
        $payment_students = Paymentstudent::all();
        return View("Payment/index", compact("payment_students"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudent_edit($id)
    {
        //return $id; 
        try {
            $payment_student = Paymentstudent::findorFail($id);
            return View("Payment/edit", compact("payment_student"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudent_update($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $studentPayRecord = Paymentstudent::findorFail($request->id);
            $studentPayRecord->date = date("y-m-d");
            $studentPayRecord->amount = $request->Debit;
            $studentPayRecord->student_id = $request->student_id;
            $studentPayRecord->description = $request->description;
            $studentPayRecord->save();

            $fundStuRecord = Foundstudent::where("paymentstudent_id", $studentPayRecord->id)->first();
            $fundStuRecord->date = date("y-m-d");
            $fundStuRecord->paymentstudent_id = $studentPayRecord->id;
            $fundStuRecord->Debit = 0.000;
            $fundStuRecord->credit = $request->Debit;
            $fundStuRecord->description = $request->description;
            $fundStuRecord->save();

            $studentAccRecord = Studentsaccounting::where("paymentstudent_id", $studentPayRecord->id)->first();
            $studentAccRecord->student_id = $request->student_id;
            $studentAccRecord->Debit = $request->Debit;
            $studentAccRecord->credit = 0.000;
            $studentAccRecord->description = $request->description;
            $studentAccRecord->type = "student payment";
            $studentAccRecord->paymentstudent_id = $studentPayRecord->id;
            $studentAccRecord->save();
            DB::commit();
            return redirect()->route("paymentStudentIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudent_delete($request)
    {
        //return $request;
        try {
            Paymentstudent::destroy($request->id); 
            return redirect()->route("paymentStudentIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
}  