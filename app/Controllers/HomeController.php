<?php

namespace App\Controllers;

class HomeController extends BaseController
{

    public function __construct(){
    }
    public function index()
    {
//        redirect()->route("admin/login");
        return view('home', $this->data);
    }


}


