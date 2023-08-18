<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait LibraryAttchments
{
    public function uploadFile($request,$fileName){
        $name= $request->file($fileName)->getClientOriginalName();
        $request->file($fileName)->storeAs("attachments/library",$name,"upload_attachments");  
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function deleteFile($name){
        $exists= Storage::disk("upload_attachments")->exists("attachments/library/".$name); 
        if($exists){
            Storage::disk("upload_attachments")->delete("attachments/library/".$name);
        }
    } 
}  
      
  