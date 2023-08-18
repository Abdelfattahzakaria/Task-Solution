<?php
namespace App\Http\Controllers;
use App\Http\Requests\GadeRequestValidation;
use App\Http\Requests\SectionStore;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class SectionController extends Controller
{
  public function sectionsList()
  {
    try {
      $grades = Grade::with(["sections"])->get();
      $gradesList = Grade::all();
      $teachers= Teacher::all();  
      return View("sections/sections", compact("grades", "gradesList","teachers"));  
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }  
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function classes($id)
  {
    //return response()->json(["key"=>"value"]);        
    $field = null;
    LaravelLocalization::getCurrentLocale() === "ar" ? $field = "name_ar" : $field = "name_en";
    try {
      return response()->json(
        Classroom::where("grade_id", $id)->pluck($field, "id")
      );
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function SectionStore(SectionStore $request)
  {
    //return $request;         
    try {
      $records = DB::table("sections")->where("grade_id", $request->Grade_id)->get();
      //return $records;    
      foreach ($records as $record) :
        if (($record->name_ar === $request->Name || $record->name_en === $request->Name_en) &&
          ($record->classroom_id === $request->Class_id)
        )
          return redirect()->back()->withErrors(trans("section.add_section_error"));
      endforeach;
      $section = new Section();
      $section->name_en = $request->Name_en;
      $section->name_ar = $request->Name;
      $section->grade_id = $request->Grade_id;
      $section->classroom_id = $request->Class_id;
      $section->save();
      $section->teachers()->attach($request->teacher_id);      
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function sectionUpdate(SectionStore $request)
  {
    //return $request;
    try {
      $records = DB::table("sections")->where("grade_id", $request->Grade_id)->get();
      //return $records;    
      foreach ($records as $record) :
        if (($record->name_ar === $request->Name || $record->name_en === $request->Name_en) &&
          ($record->classroom_id == $request->Class_id) &&
          ($record->grade_id == $request->Grade_id) &&
          (!isset($request->Status))&&
          (!isset($request->teacher_id))
        )
          return redirect()->back()->withErrors(trans("section.add_section_error"));
      endforeach;
      $section = Section::findorFail($request->id);
      $section->update([
        "name_en" => $request->Name,
        "name_ar" => $request->Name_en,
        "grade_id " => $request->Grade_id,
        "classroom_id " => $request->Class_id,
      ]);
      if (isset($request->Status))
        $section->status === 0 ? $section->status = 1 : $section->status = 0;
      if(isset($request->teacher_id)){
        $section->teachers()->sync($request->teacher_id);     
      }else{
        $section->teachers()->sync(array());   
      }       
      $section->save();
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }   
  //-------------------------------------------------------------------------------------------------------------------
  //-------------------------------------------------------------------------------------------------------------------
  public function deleteSection(Request $request){
    //return $request; 
    try{ 
      Section::where("id",$request->id)->delete(); 
      return redirect()->back();  
    }catch(\Exception $e){
      return redirect()->back()->withErrors(["error"=>$e->getMessage()]);   
    }
  }
}
             