<?php

namespace App\Repositery\UserRegisteration;

use App\Interfaces\UserRegisteration\UserRegisterationRepositeryInterface;
use App\Models\UserRegisterInfo;
use Illuminate\Support\Facades\DB;

class UserRegisterationRepositery implements UserRegisterationRepositeryInterface
{
    public function Store($request)
    {
        DB::beginTransaction();
        try {
            $userRecord = new UserRegisterInfo();
            if ($request->hasfile('photo')) {
                $photoName = $request->file('photo')->getClientOriginalName();
                uploadFiles("usersphotos", $request->file('photo'), "user_attachments");  
                $userRecord->photoName = $photoName;
            }
            $userRecord->fname = $request->fname;
            $userRecord->lname = $request->lname;
            $userRecord->save();
            return back()->with("data","your data has been saved!");       
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();   
            return redirect()->back()->with(["error" => $e->getMessage()]);
        }
    } 
} 
    

 
   

        
 



