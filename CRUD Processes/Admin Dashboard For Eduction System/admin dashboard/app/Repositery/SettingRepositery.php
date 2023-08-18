<?php

namespace App\Repositery;

use App\Models\Setting;
use Illuminate\Contracts\View\View;

use function PHPUnit\Framework\returnSelf;

class SettingRepositery implements SettingRepositeryInterface
{
    public function index()
    {
        try {
            $collection= Setting::all();
            //return $colllection; 
            $data["setting"]= $collection->flatMap(function($collection){
                return [$collection->key => $collection->value]; 
            });
            //return $data;
            return View("setting/index",$data);      
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
            $data= $request->except("_token","_method","logo");
            //return $data;
            foreach($data as $key=>$value):
                Setting::where("key",$key)->update(["value"=>$value]);    
            endforeach;   
            if($request->hasfile("logo")){
                $name= $request->file("logo")->getClientOriginalName(); 
                $request->file("logo")->storeAs("attachments/logo",$name,"upload_attachments");  
                Setting::where("key","logo")->update(["value"=>$name]);     
            } 
            return redirect()->route("settingIndex");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }   
    }                     
}    
        