<?php

namespace App\Http\Controllers;

use App\Repositery\SettingRepositeryInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $Setting;
    public function __construct(SettingRepositeryInterface $Setting)
    {
        $this->Setting = $Setting;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function settingIndex(){
        return $this->Setting->index();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function settingupdate(Request $request){
        return $this->Setting->update($request);
    }
}
  