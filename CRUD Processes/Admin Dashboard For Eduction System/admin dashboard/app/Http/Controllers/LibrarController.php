<?php

namespace App\Http\Controllers;

use App\Http\Requests\LibraryRequest;
use App\Repositery\LibraryRepositeryInterface;
use Illuminate\Http\Request;

class LibrarController extends Controller
{
    protected $Library;
    public function __construct(LibraryRepositeryInterface $Library)
    {
        $this->Library= $Library;
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryIndex(){
        return $this->Library->index();   
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryAdd(){
        return $this->Library->create();
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryStore(LibraryRequest $request){
        return $this->Library->store($request);
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryDownload($id){
        return $this->Library->download($id); 
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryEdit($id){
        return $this->Library->edit($id); 
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryUpdate(LibraryRequest $request){
        return $this->Library->update($request); 
    }
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    public function libraryDelete(Request $request){
        return $this->Library->destory($request);  
    }
}  
 