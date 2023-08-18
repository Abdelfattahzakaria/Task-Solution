<?php 
namespace App\Repositery; 
interface QuestionsRepositeryInterface{
    public function question_index(); 

    public function question_create();
    
    public function question_store($request);
    
    public function question_edit($id); 
    
    public function question_update($request);
    
    public function question_destory($request);  
}  