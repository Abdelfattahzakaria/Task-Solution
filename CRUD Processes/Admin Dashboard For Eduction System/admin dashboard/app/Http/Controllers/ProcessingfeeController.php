<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessingFeesRequest;
use App\Repositery\ProcessingFeesRepositeryInterface;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;

class ProcessingfeeController extends Controller
{
    protected $PrecessingFees;
    public function __construct(ProcessingFeesRepositeryInterface $PrecessingFees)
    {
        $this->PrecessingFees = $PrecessingFees;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function processingFeesAdd($id)
    {
        return $this->PrecessingFees->PrecessingFees_add($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function precessingFeesStore(ProcessingFeesRequest $request)
    {
        return $this->PrecessingFees->ProcessingFees_store($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function processingFeesIndex()
    {
        return $this->PrecessingFees->ProcessingFees_index();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function processingFeesEdit($id)
    {
        return $this->PrecessingFees->ProcessingFees_edit($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function processingFeesUpdate(Request $request)
    {
        return $this->PrecessingFees->ProcessingFees_update($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    public function processingFeesDelete(Request $request)
    {
        return $this->PrecessingFees->ProcessingFees_delete($request);
    }
}
 