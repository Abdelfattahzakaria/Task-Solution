<?php
namespace App\Http\Controllers;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Repositery\TeacherRepositeryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class TeacherController extends Controller
{
  protected $Teacher;
  public function __construct(TeacherRepositeryInterface $Teacher)
  {
    $this->Teacher = $Teacher;
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function teachersList()
  {
    //return "Hello";
    //return $this->Teacher->getAllTechers(); 
    $Teachers = $this->Teacher->getAllTechers();
    return View("Teachers/Teachers", compact("Teachers"));
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function addTeacher()
  {
    $genders = $this->Teacher->getGenders();
    $specializations = $this->Teacher->getSpecialtions();
    return View("Teachers/create", compact("specializations", "genders"));
  }  
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function teacherStore(TeacherRequest $request)
  {
    //return $request;  
    return $this->Teacher->store($request);
  }     
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function teacherEdit($id){
    //return $id;
    //return $this->Teacher->edit($id);
    $Teachers= $this->Teacher->edit($id);   
    $genders= $this->Teacher->getGenders(); 
    $specializations= $this->Teacher->getSpecialtions();   
    return View("Teachers/Edit",compact("Teachers","genders","specializations"));       
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function teacherUpdate(TeacherRequest $request){  
    //return $request;  
    return $this->Teacher->update($request); 
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function teacherDelete(Request $request){
    //return $request; 
    return $this->Teacher->delete($request);   
  }    
}  
      