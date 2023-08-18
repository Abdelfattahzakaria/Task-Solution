<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectsRequest;
use App\Repositery\SubjectsRepositeryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{   
    protected $Subject; 
    public function __construct(SubjectsRepositeryInterface $Subject)
    {
        $this->Subject= $Subject;          
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjectsIndex(){
        return $this->Subject->subjects_index();  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjectCreate(){
        return $this->Subject->subjects_create();   
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjectsStore(SubjectsRequest $request){
        return $this->Subject->subjects_store($request);  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjectEdit($id){
        return $this->Subject->subjects_edit($id);  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function subjectUpdate(SubjectsRequest $request){
        return $this->Subject->subject_update($request);  
    }

    public function subjectDelete(Request $request){
        return $this->Subject->subject_delete($request); 
    }
}
    