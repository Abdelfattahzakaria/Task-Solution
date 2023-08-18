<?php

namespace App\Repositery;

use App\Models\Question;
use App\Models\Quiz;
use GuzzleHttp\Psr7\Query;
use Illuminate\Contracts\View\View;

class QuestionsRepositery implements QuestionsRepositeryInterface
{
    public function question_index()
    {
        try {
            $questions = Question::all();
            return View("Questions/index", compact("questions"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }    
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function question_create()
    {
        try {
            $quizzes= Quiz::all(); 
            return View("Questions/create",compact("quizzes"));  
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }  
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function question_store($request)
    {
        //return $request;
        try {
            $questionNewRecord= new Question();
            $questionNewRecord->title= $request->title;
            $questionNewRecord->answers= $request->answers;
            $questionNewRecord->right_answer= $request->right_answer;
            $questionNewRecord->score= $request->score;
            $questionNewRecord->quizze_id = $request->quizze_id;
            $questionNewRecord->save();   
            return redirect()->route("questionCreate");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }    
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function question_edit($id)
    {
        //return $id;
        try {
            $question= Question::findorFail($id);
            $quizzes= Quiz::all(); 
            return View("Questions/edit",compact("question","quizzes"));  
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }  
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function question_update($request)
    {
         //return $request;
         try {
            $questionNewRecord= Question::findorFail($request->id);  
            $questionNewRecord->title= $request->title;
            $questionNewRecord->answers= $request->answers;
            $questionNewRecord->right_answer= $request->right_answer;
            $questionNewRecord->score= $request->score;
            $questionNewRecord->quizze_id = $request->quizze_id;
            $questionNewRecord->save();   
            return redirect()->route("questionsList");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }    
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function question_destory($request)
    {
        //return $request;
        try {
            Question::destroy($request->id);
            return redirect()->route("questionsList");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}
