<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

use function PHPUnit\Framework\returnSelf;

trait AuthGaurd
{
    public function checkGuard($request)
    {
        if ($request->type == "student")
            $guardName = "student";
        elseif ($request->type == "teacher")
            $guardName = "teacher";
        elseif ($request->type == "pareent")
            $guardName = "pareent";
        else
            $guardName = "web";
        return $guardName;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function redirect($request)
    {
        if ($request->type == "student")
            return redirect()->intended(RouteServiceProvider::STUDENT);
        elseif ($request->type == "teacher")
            return redirect()->intended(RouteServiceProvider::TEACHER);
        elseif ($request->type == "pareent")
            return redirect()->intended(RouteServiceProvider::PARENT);
        else
            return redirect()->intended(RouteServiceProvider::HOME);
    }
}   
  