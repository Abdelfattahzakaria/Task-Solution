<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Repositery\QuestionsRepositeryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $Question;
    public function __construct(QuestionsRepositeryInterface $Question)
    {
        $this->Question = $Question;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function questionsList(){
        return $this->Question->question_index();  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function questionCreate(){
        return $this->Question->question_create();  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function questionStore(QuestionRequest $request){
        return $this->Question->question_store($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function questionEdit($id){
        return $this->Question->question_edit($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function questionUpdate(QuestionRequest $request){
        return $this->Question->question_update($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function questionDelete(Request $request){
        return $this->Question->question_destory($request);
    }
}
