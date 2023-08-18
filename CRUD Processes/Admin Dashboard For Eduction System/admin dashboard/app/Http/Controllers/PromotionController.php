<?php

namespace App\Http\Controllers;

use App\Repositery\StudentPromotionsInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $Promotion;
    public function __construct(StudentPromotionsInterface $Promotion)
    {
        $this->Promotion = $Promotion;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function index()
    {
        return $this->Promotion->student_promotions_index();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function promotionStore(Request $request)
    {
        return $this->Promotion->student_store_prpomotion($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function promotionsDisplay()
    {
        return $this->Promotion->display_students_promotion();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function promotionsDeleteAll(Request $request){
        return $this->Promotion->delete_all_studentds_promotions($request);   
    }
}
