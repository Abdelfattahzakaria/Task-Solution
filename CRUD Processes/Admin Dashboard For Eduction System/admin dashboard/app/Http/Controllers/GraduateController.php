<?php

namespace App\Http\Controllers;

use App\Http\Requests\GratuateRequest;
use App\Repositery\GraduateRepositeryInterface;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    protected $Graduate;
    public function __construct(GraduateRepositeryInterface $Graduate)
    {
        $this->Graduate = $Graduate;
    }
    public function createGraduate()
    {
        return $this->Graduate->create_graduate();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduateSoftDeletes(GratuateRequest $request)
    {
        return $this->Graduate->graduate_soft_deletes($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduateIndex()
    {
        return $this->Graduate->graduate_index();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduateRestore(Request $request)
    {
        return $this->Graduate->graduate_restore($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function graduateDelete(Request $request)
    {
        return $this->Graduate->graduate_delete($request); 
    }
}
