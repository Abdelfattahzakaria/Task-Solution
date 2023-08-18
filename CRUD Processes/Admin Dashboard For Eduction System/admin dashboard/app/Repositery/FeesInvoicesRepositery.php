<?php

namespace App\Repositery;

use App\Models\Fee;
use App\Models\Feesinvoices;
use App\Models\Student;
use App\Models\Studentsaccounting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Builder\Stub;

class FeesInvoicesRepositery implements FeesInvoicesRepositeryInterface
{
    public function feesInvoices_index()
    {
        $Fee_invoices = Feesinvoices::all();
        return view("Fees_Invoices/index", compact("Fee_invoices"));
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoices_add($id)
    {
        //return $id;  
        try {
            $student = Student::findorFail($id);
            $fees = Fee::where("classroom_id", $student->classroom_id)->get();
            return View("Fees_Invoices/add", compact("student", "fees"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function feesInvoices_store($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            foreach ($request->List_Fees as $List_Fee) :
                $feesInvoicesRecord = new Feesinvoices();
                $feesInvoicesRecord->invoice_date = date("y-m-d");
                $feesInvoicesRecord->student_id = $List_Fee["student_id"];
                $feesInvoicesRecord->grade_id  = $request->Grade_id;
                $feesInvoicesRecord->classroom_id  = $request->Classroom_id;
                $feesInvoicesRecord->fee_id   = $List_Fee["fee_id"];
                $feesInvoicesRecord->amount   = $List_Fee["amount"];
                $feesInvoicesRecord->description  = $List_Fee["description"];
                $feesInvoicesRecord->save();

                $studentAccountingRecord = new Studentsaccounting();
                $studentAccountingRecord->student_id = $List_Fee["student_id"];
                $studentAccountingRecord->Debit = $List_Fee["amount"];
                $studentAccountingRecord->credit = 0.000;
                $studentAccountingRecord->type = "invoice";
                $studentAccountingRecord->feesinvoice_id = $feesInvoicesRecord->id;
                $studentAccountingRecord->description = $List_Fee["description"];
                $studentAccountingRecord->save();
                DB::commit();
            endforeach;
            return redirect()->route("feesInvoicesIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoices_edit($id)
    {
        //return $id;  
        try {
            $fee_invoices = Feesinvoices::findorFail($id);
            $fees = Fee::where("classroom_id", $fee_invoices->classroom_id)->get();
            return View("Fees_Invoices/edit", compact("fee_invoices", "fees"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoices_update($request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            $Fees = Feesinvoices::findorfail($request->id);
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            $StudentAccount = Studentsaccounting::where("student_id", $Fees->student_id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();    
            DB::commit();
            return redirect()->route("feesInvoicesIndex");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoices_delete($request)
    {
        //return $request;
        try {
            Feesinvoices::destroy($request->id);
            return redirect()->route("feesInvoicesIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}
