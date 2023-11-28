<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentcontroller extends Controller
{
    //
    public $student = array(
        array("E21D001","John",23),
        array("E21D002","Sara",18),
        array("E21D003","Mick",21),
    );
    public function list()
    {
        $students = $this->student;
        return view('studentlist', ['students'=>$students]);
    }

    public function getByID(Request $request)
    {
        return $reques->id;
    }
}
