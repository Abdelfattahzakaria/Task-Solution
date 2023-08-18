<?php
namespace App\Http\Controllers;
use App\Http\Requests\classroomRequest;
use App\Http\Requests\GadeRequestValidation;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use function PHPUnit\Framework\returnSelf;

class ClassroomController extends Controller
{
    public function classroomList()
    {
        try {
            $classrooms = Classroom::all();
            $grades = Grade::all();
            return View("classrooms/classroomList", compact("classrooms", "grades"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //----------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------
    public function classroomStore(Request $request)
    {
        $request->validate([
            "List_Classes.*.Name" => "required",
            "List_Classes.*.Name_class_en" => "required",
        ], [
            "Name.required" => trans("validation.required"),
            "Name_class_en.required" => trans("validation.required"),
        ]);
        try {
            //return $request;    
            $List_Classes = $request->List_Classes;
            //return $List_Classes;   
            foreach ($List_Classes as $newClasss) :
                $class = new Classroom();
                $records = DB::table("classrooms")->where("grade_id", $newClasss["Grade_id"])->get();
                foreach ($records as $record) :
                    if ($record->name_ar === $newClasss["Name"] || $record->name_en === $newClasss["Name_class_en"])
                        return redirect()->back()->withErrors(trans("classroom_list.error"));
                endforeach;
                $class->name_ar = $newClasss["Name"];
                $class->name_en = $newClasss["Name_class_en"];
                $class->grade_id = $newClasss["Grade_id"];
                $class->save();
            endforeach;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
        return redirect()->back();
    }
    //----------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------
    public function classroomUpdate(GadeRequestValidation $request)
    {
        //return $request;  
        $records = DB::table("classrooms")->where("grade_id", $request->Grade_id)->get();
        //return $records;   
        foreach ($records as $record) :
            if ($record->name_ar === $request->Name || $record->name_en === $request->Name_en)
                return redirect()->back()->withErrors(trans("classroom_list.error"));
        endforeach;
        try {
            $classroom = Classroom::findorFail($request->id);
            $classroom->update([
                "name_ar" => $request->Name,
                "name_en" => $request->Name_en,
                "grade_id" => $request->Grade_id,
            ]);
            $classroom->save();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //----------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------  
    public function deleteClassroom(Request $request)
    {
        //return $request;   
        $sections = Section::where("classroom_id", $request->id)->pluck("id");
        if ($sections->count() !== 0)
            return redirect()->back()->withErrors(trans("classroom_list.delete_error"));
        try {
            Classroom::findorFail($request->id)->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //----------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------  
    public function deleteAllSelectedClassrooms(Request $request)
    {
        //return $request;   
        try {
            $recordsIds = explode(",", $request->delete_all_id);
            //return $recordsIds; 
            foreach ($recordsIds as $recordsId) :
                $sections = Section::where("classroom_id", $recordsId)->pluck("id");
                if($sections->count() !== 0)
                    return redirect()->back()->withErrors(trans("classroom_list.delete_error"));
                Classroom::where("id",$recordsId)->delete();     
            endforeach;
            //Classroom::whereIn("id", $recordsIds)->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    } 
    //----------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------   
    public function classroomSearch(Request $request)
    {
        //return $request;   
        try {
            $grades = Grade::all();
            $searchData = Classroom::select("*")->where("grade_id", "=", $request->Grade_id)->get();
            return View("classrooms/classroomList", compact("grades"))->with("searchData", $searchData);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}  
   