<?php 
namespace App\Interfaces\UserRegisteration;

use SebastianBergmann\Type\VoidType;

interface UserRegisterationRepositeryInterface
{
    public function Store($request);   
}