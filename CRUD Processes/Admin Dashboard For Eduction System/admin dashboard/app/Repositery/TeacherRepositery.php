<?php
namespace App\Repositery;

use App\Http\Requests\TeacherRequest;
use App\Models\Gender;
use App\Models\Specialtion;
use App\Models\Teacher;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Translation\CatalogueMetadataAwareInterface;

class TeacherRepositery implements TeacherRepositeryInterface{
  public function getAllTechers(){
    return Teacher::all(); 
  }  
  //------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------
  public function getGenders(){
    return Gender::all(); 
  }
  //------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------
  public function getSpecialtions(){
    return Specialtion::all();   
  }
  //------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------
  public function store($request){
    //return $request;
    try{   
      $newTeacherRecord= new Teacher();   
      $newTeacherRecord->Email= $request->Email; 
      $newTeacherRecord->Password= Hash::make($request->Password);
      $newTeacherRecord->Name_Ar= $request->Name_ar; 
      $newTeacherRecord->Name_En= $request->Name_en;
      $newTeacherRecord->specialtion_id= $request->Specialization_id;   
      $newTeacherRecord->gender_id= $request->Gender_id;      
      $newTeacherRecord->Joining_Date= $request->Joining_Date;
      $newTeacherRecord->Address= $request->Address;   
      $newTeacherRecord->save();  
      return redirect()->route("teachersList");        
    }catch(\Exception $e){
      return redirect()->back()->withErrors(["error"=>$e->getMessage()]);   
    }          
  }           
  //------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------
  public function edit($id)
  {
    //return $id;
    return Teacher::findorFail($id);       
  } 
  //------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------
  public function update(TeacherRequest $request)
  {
    //return $request; 
    try{   
      $newTeacherRecord= Teacher::findorFail($request->id);     
      $newTeacherRecord->Email= $request->Email; 
      $newTeacherRecord->Password= Hash::make($request->Password);
      $newTeacherRecord->Name_Ar= $request->Name_ar; 
      $newTeacherRecord->Name_En= $request->Name_en;
      $newTeacherRecord->specialtion_id= $request->Specialization_id;   
      $newTeacherRecord->gender_id= $request->Gender_id;      
      $newTeacherRecord->Joining_Date= $request->Joining_Date;
      $newTeacherRecord->Address= $request->Address;   
      $newTeacherRecord->save();  
      return redirect()->route("teachersList");        
    }catch(\Exception $e){
      return redirect()->back()->withErrors(["error"=>$e->getMessage()]);   
    }         
  }
  //------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------
  public function delete($request)
  { 
    //return $request;
    try{
      Teacher::findorFail($request->id)->delete();  
      return redirect()->route("teachersList"); 
    }catch(\Exception $e){
       return redirect()->back()->withErrors(["error"=>$e->getMessage()]);  
    }
  }       
}                                 