<?php

namespace App\Http\Controllers\UserRegisteration;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Interfaces\UserRegisteration\UserRegisterationRepositeryInterface;
use Illuminate\Http\Request;

class UserRegisterationController extends Controller
{
    protected $Registeration; 
    public function __construct(UserRegisterationRepositeryInterface $Registeration)
    {
        $this->Registeration= $Registeration; 
    }
    //-----------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------
    public function UserRegisterationStore(UserRegisterRequest $request)  
    {
        return $this->Registeration->Store($request);     
    }
} 
  