<?php

namespace App\Repositery;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Bloodtybe;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationalit;
use App\Models\Pareent;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepositery implements StudentRepositeryInterface
{
  public function create_student()
  {
    //return "Hello";
    $data["genders"] = Gender::all();
    $data["nationals"] = Nationalit::all();
    $data["bloods"] = Bloodtybe::all();
    $data["my_grades"] = Grade::all();
    $data["parents"] = Pareent::all();
    return View("Students/add", $data);
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------  
  public function get_classrooms($id)
  {
    $field = null;
    LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
    return response()->json(
      Classroom::where("grade_id", $id)->pluck($field, "id")
    );      
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function get_Sections($id)
  {
    $field = null;
    LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
    return response()->json(
      Section::where("classroom_id", $id)->pluck($field, "id")
    );  
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function store($request)
  {
    //return $request;
    //return $request->photos;
    DB::beginTransaction();
    try {
      $students = new Student();
      $students->name_ar = $request->name_ar;
      $students->name_en = $request->name_en;
      $students->email = $request->email;
      $students->password = Hash::make($request->password);
      $students->gender_id = $request->gender_id;
      $students->nationalit_id = $request->nationalitie_id;
      $students->bloodtybe_id = $request->blood_id;
      $students->Date_Birth = $request->Date_Birth;
      $students->grade_id = $request->Grade_id;
      $students->classroom_id = $request->Classroom_id;
      $students->section_id = $request->section_id;
      $students->pareent_id = $request->parent_id;
      $students->academic_year = $request->academic_year;
      $students->save();
      if ($request->hasfile("photos")) {
        foreach ($request->file("photos") as $photo) :
          $name = $photo->getClientOriginalName();
          $photo->storeAs("attachments/students/" . $students->name_ar, $name, "upload_attachments");
          $images = new Image();
          $images->fileName = $name;
          $images->imageable_id = $students->id;
          $images->imageable_type = "App\Models\Student";
          $images->save();
        endforeach;
      }
      DB::commit();
      return redirect()->route('createStudent');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function get_Students()
  {
    try {
      $students = Student::all();
      return View("Students/index", compact("students"));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function student_edit($id)
  {
    try {
      //return $id;
      $data["Genders"] = Gender::all();
      $data["nationals"] = Nationalit::all();
      $data["bloods"] = Bloodtybe::all();
      $data["Grades"] = Grade::all();
      $data["parents"] = Pareent::all();
      $Students = Student::findorFail($id);
      return View("Students/edit", $data, compact("Students"));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------- 
  public function student_update($request)
  {
    //return $request;
    try {
      $students = Student::findorFail($request->id);
      $students->name_ar = $request->name_ar;
      $students->name_en = $request->name_en;
      $students->email = $request->email;
      $students->password = Hash::make($request->password);
      $students->gender_id = $request->gender_id;
      $students->nationalit_id = $request->nationalitie_id;
      $students->bloodtybe_id = $request->blood_id;
      $students->Date_Birth = $request->Date_Birth;
      $students->grade_id = $request->Grade_id;
      $students->classroom_id = $request->Classroom_id;
      $students->section_id = $request->section_id;
      $students->pareent_id = $request->parent_id;
      $students->academic_year = $request->academic_year;
      $students->save();
      return redirect()->route("studentList");
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function student_delete($request)
  {
    try {
      Student::findorFail($request->id)->delete();
      return redirect()->route("studentList");
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function show_student_details($id)
  {
    //return $id;   
    try {
      $Student = Student::findorFail($id);
      return View("Students/show", compact("Student"));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function upload_attachments($request)
  {
    //return $request; 
    try {
      if ($request->hasfile("photos")) {
        foreach ($request->file("photos") as $photo) :
          $name = $photo->getClientOriginalName();
          $photo->storeAs("attachments/students/" . $request->student_name, $name, "upload_attachments");
          $images = new Image();
          $images->fileName = $name;
          $images->imageable_id = $request->student_id;
          $images->imageable_type = "App\Models\Student";
          $images->save();
        endforeach;
        return redirect()->route("showStudentDetails", $request->student_id);
      }
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function download_student_attachment($studentName, $fileName)
  {
    //return $studentName; 
    //return $fileName;  
    try {
      return response()->download(public_path("attachments/students/" . $studentName . "/" . $fileName));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function delete_student_attachment($request)
  {
    //return $request; 
    try{
      Storage::disk("upload_attachments")->delete("attachments/students/".$request->student_name."/".$request->filename);
      Image::findorFail($request->id)->delete();
      return redirect()->route("showStudentDetails",$request->student_id); 
    }catch(\Exception $e){
       return redirect()->back()->withErrors(["error"=>$e->getMessage()]); 
    }
  }
} 
 
 
  