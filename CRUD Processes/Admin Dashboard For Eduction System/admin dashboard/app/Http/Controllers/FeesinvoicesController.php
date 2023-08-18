<?php

namespace App\Http\Controllers;

use App\Repositery\FeesInvoicesRepositery;
use Illuminate\Http\Request;

class FeesinvoicesController extends Controller
{
    protected $FeesInvoices;
    public function __construct(FeesInvoicesRepositery $FeesInvoices)
    {
        $this->FeesInvoices = $FeesInvoices;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoicesIndex()
    {
        return $this->FeesInvoices->feesInvoices_index();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoicesAdd($id)
    {
        return $this->FeesInvoices->feesInvoices_add($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoivesStore(Request $request)
    {
        return $this->FeesInvoices->feesInvoices_store($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoicesEdit($id)
    {
        return $this->FeesInvoices->feesInvoices_edit($id);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoicesUpdate(Request $request)
    {
        return $this->FeesInvoices->feesInvoices_update($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function feesInvoicesDelete(Request $request)
    {
        return $this->FeesInvoices->feesInvoices_delete($request);
    } 
}
