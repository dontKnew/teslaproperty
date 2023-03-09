<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {

        $data = array(
            "dashboard"=>"active", 
        );

        return view("admin/dashboard", $data);
    }
}
