<?php

namespace App\Repositery;

interface QuizRepositeryInterface
{
    public function index();
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function create();
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function store($request);
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function edit($id);
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function update($request);
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    public function delete($request);
}
 