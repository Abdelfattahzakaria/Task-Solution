<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStudentUpdate;
use App\Http\Requests\PaymentStudentValidation;
use App\Repositery\PaymentStudentRepositeryInterface;
use Illuminate\Http\Request;

class PaymentstudentController extends Controller
{
    protected $PaymentStudent;
    public function __construct(PaymentStudentRepositeryInterface $PaymentStudent)
    {
        $this->PaymentStudent= $PaymentStudent;  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudentAdd($id){
        return $this->PaymentStudent->paymentStudent_add($id); 
    }   
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudentStore(PaymentStudentValidation $request){
        return $this->PaymentStudent->paymentStudent_store($request); 
    }  
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudentIndex(){
        return $this->PaymentStudent->paymentStudent_index();  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudentEdit($id){
        return $this->PaymentStudent->paymentStudent_edit($id);      
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudentUpdate(PaymentStudentUpdate $request){
        return $this->PaymentStudent->paymentStudent_update($request);  
    }     
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function paymentStudentDelete(Request $request){
        return $this->PaymentStudent->paymentStudent_delete($request);  
    }
}
    