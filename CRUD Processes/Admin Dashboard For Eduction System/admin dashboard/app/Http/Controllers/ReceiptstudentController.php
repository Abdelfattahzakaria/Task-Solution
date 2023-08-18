<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRecieptRequest;
use App\Repositery\RecieptStudentRepositeryInterface;
use Illuminate\Http\Request;

class ReceiptstudentController extends Controller
{
    protected $StudentReciept;
    public function __construct(RecieptStudentRepositeryInterface $StudentReciept)
    {
        $this->StudentReciept = $StudentReciept;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function studentAddReciept($id)
    {
        return $this->StudentReciept->student_add_reciept($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function studentRecieptStore(StudentRecieptRequest $request)
    {
        return $this->StudentReciept->student_store_reciept($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function studentRecieptIndex()
    {
        return $this->StudentReciept->student_index_reciept();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function studentRecieptEdit($id)
    {
        return $this->StudentReciept->student_edit_reciet($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function studentRecieptUpdate(StudentRecieptRequest $request)
    {
        return $this->StudentReciept->student_update_reciept($request); 
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function studentRecieptDelete(Request $request){
        return $this->StudentReciept->student_delete_reciept($request); 
    } 
}
