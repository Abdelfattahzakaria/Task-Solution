<?php

namespace App\Repositery;

interface StudentPromotionsInterface
{
    public function student_promotions_index();
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function student_store_prpomotion($request);
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function display_students_promotion();
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function delete_all_studentds_promotions($request);  
}
 