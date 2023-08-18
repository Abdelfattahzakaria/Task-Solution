<?php

namespace App\Repositery;

use App\Http\Traits\LibraryAttchments;
use App\Models\Grade;
use App\Models\Librar;
use Illuminate\Contracts\View\View;

class LibraryRepositery implements LibraryRepositeryInterface
{
    use LibraryAttchments;
    public function index()
    {
        try {
            $books = Librar::all();
            return View("library/index", compact("books"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function create()
    {
        try {
            $grades = Grade::all();
            return View("library/create", compact("grades"));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function store($request)
    {   
        //return $request;
        try {
            $newLibraryRecord= New Librar(); 
            $newLibraryRecord->title= $request->title;
            $newLibraryRecord->file_name= $request->file("file_name")->getClientOriginalName();   
            $newLibraryRecord->grade_id = $request->Grade_id;
            $newLibraryRecord->classroom_id = $request->Classroom_id;
            $newLibraryRecord->section_id  = $request->section_id;
            $newLibraryRecord->teacher_id  = 1; 
            $this->uploadFile($request,"file_name");
            $newLibraryRecord->save(); 
            return redirect()->route("libraryIndex");  
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }      
    }        
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function download($id)
    {
        //return $id; 
        try {
            $fileName= Librar::where("id",$id)->first()->file_name; 
            //return $fileName;
            return response()->download(public_path("attachments/library/".$fileName));   
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }             
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function edit($id)
    {   
        //return $id;
        try {
            $data["grades"]= Grade::all();
            $data["book"]= Librar::findorFail($id);  
            return View("library/edit",$data);   
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function update($request)
    {   
        //return $request;
        try {
            $libraryRecord= Librar::findorFail($request->id);
            if($request->hasfile("file_name")){
                $this->deleteFile($libraryRecord->file_name);
                $this->uploadFile($request,"file_name");
                $newFileName= $request->file("file_name")->getClientOriginalName();
                $libraryRecord->file_name= $libraryRecord->file_name!==$newFileName?$newFileName:$libraryRecord->file_name;
            }
            $libraryRecord->title= $request->title;
            $libraryRecord->grade_id = $request->Grade_id;
            $libraryRecord->classroom_id = $request->Classroom_id;
            $libraryRecord->section_id  = $request->section_id;
            $libraryRecord->teacher_id  = 1; 
            $libraryRecord->save();  
            return redirect()->route("libraryIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        } 
    }         
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function destory($request)
    {
        //return $request;
        try {
            $this->deleteFile($request->file_name);
            Librar::destroy($request->id);
            return redirect()->route("libraryIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}
    