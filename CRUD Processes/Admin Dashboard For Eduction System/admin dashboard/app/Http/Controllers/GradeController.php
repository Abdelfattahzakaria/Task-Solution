<?php
namespace App\Http\Controllers;
use App\Http\Requests\GadeRequestValidation;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpParser\Node\Expr\New_;
use function PHPUnit\Framework\returnSelf;

class GradeController extends Controller
{
  public function gradesList()
  {
    try {
      $grades = Grade::all();
      return View("grades/gradesList", compact("grades"));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------
  public function gradeStore(GadeRequestValidation $request)
  {
    //return $request; 
    if (Grade::where("name_en", $request->Name_en)->orWhere("name_ar", $request->Name)->exists())
      return redirect()->back()->withErrors(trans('grades_list.exists'));
    try {
      $grade = new Grade();
      $grade->name_en = $request->Name_en;
      $grade->name_ar = $request->Name;
      $grade->notes = $request->Notes;
      $grade->save();
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------
  public function gradeUpdate(GadeRequestValidation $request)
  {
    $grade = Grade::findorFail($request->id); 
    if (Grade::where("name_en", $request->Name_en)->orWhere("name_ar", $request->Name)->exists()) {
      $name_ar = Grade::where("id", $request->id)->pluck("name_ar");
      //return $name_ar; 
      $name_en = Grade::where("id", $request->id)->pluck("name_en");
      //return $name_en; 
      $notes = Grade::where("id", $request->id)->pluck("notes");
      //return $notes; 
      if ($name_ar[0] == $request->Name && $name_en[0] == $request->Name_en && $notes[0] != $request->Notes) { 
        $grade->update([
          "name_en" => $request->Name_en,
          "name_ar" => $request->Name,
          "notes" => $request->Notes,
        ]);
        $grade->save();
        return redirect()->back();
      } else
        return redirect()->back()->withErrors(trans('grades_list.exists'));
    }
    try {
      //return $request;    
      $grade->update([
        "name_en" => $request->Name_en,
        "name_ar" => $request->Name,
        "notes" => $request->Notes,
      ]);
      $grade->save();
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(["error" => $e->getMessage()]);
    }
  }
  //------------------------------------------------------------------------------------------------------------------
  //------------------------------------------------------------------------------------------------------------------
  public function deleteGrade(Request $request)
  {
    //return $request;
    $classrooms_ids = Classroom::where("grade_id", $request->id)->pluck("id");
    //return $classrooms_ids;
    if ($classrooms_ids->count() === 0) {
      try {
        Grade::findorFail($request->id)->delete();
        return redirect()->back();
      } catch (\Exception $e) {
        return redirect()->back()->withErrors(["error" => $e->getMessage()]);
      }
    } else {
      return redirect()->back()->withErrors(trans("grades_list.delete_error"));
    }
  }
}
    