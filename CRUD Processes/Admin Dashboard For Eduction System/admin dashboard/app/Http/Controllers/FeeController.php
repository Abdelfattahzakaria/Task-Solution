<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeesRequest;
use App\Repositery\FeesRepositeryInterface;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected $Fee;
    public function __construct(FeesRepositeryInterface $Fee)
    {
        $this->Fee = $Fee;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesIndex()
    {
        return $this->Fee->fees_index();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesAdd()
    {
        return $this->Fee->fees_add();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesStore(FeesRequest $request)
    {
        return $this->Fee->fees_store($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesEdit($id)
    {
        return $this->Fee->fees_edit($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesUpdate(FeesRequest $request)
    {
        return $this->Fee->fees_update($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesDelete(Request $request)
    {
        return $this->Fee->fees_delete($request);
    }
} 
