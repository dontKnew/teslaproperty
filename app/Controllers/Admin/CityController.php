<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\StateModel;


class CityController extends BaseController
{
    public function index()
    {
        $result_number  = 15;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $CityModel = new CityModel();
        $City = $CityModel->select("state.name as state_name, city.*")->orderBy("name","asc")->join("state", "state.id=city.state")->paginate($result_number);

        $pager['pagination'] = $CityModel->pager->getDetails();
        $pager['pagination']['path'] = $CityModel->pager->getPageURI();
        $pager['pagination']['get_last_page'] = $CityModel->pager->getLastPage();

        $data = array(
            "city"=>"active",
            "data"=>$City,
            "pager"=>$pager,
            'cityCount'=>count($CityModel->findAll())
        );

        return view("admin/city/index", $data);
    }

    public function add(){

        if($this->request->getPostGet()){
            $session = session();
            try {
                $data = $this->request->getVar();
                $cities = explode(",", $data['name']);
                foreach ($cities as $city){
                    $data['name'] = $city;
                    $data['url'] = url_title($city, '-', true);
                    $CityModel = new CityModel();
                    $CityModel->save($data);
                }
                $session->setFlashdata("msg","City add successfully");
                return redirect()->route("admin/city");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/city");
        }
        $data['state_list'] = (new StateModel)->orderBy("name", "asc")->findAll();
        return view("admin/city/add", $data);
    }

    public function update($id){
            $session = session();
            $CityModel = new CityModel();
            $CityModelData= $CityModel->find($id);
            if($this->request->getPostGet()){
                try {
                    $data = $this->request->getVar();
                    $data['id'] = $id;
                    $data['url'] = url_title($data['name'], '-', true);

                    $CityModel->save($data);
                    $session->setFlashdata("msg","City updated successfully");
                    return redirect()->route("admin/city");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/city");
            }else {
                $state_list = (new StateModel)->orderBy("name", "asc")->findAll();
                $data = array(
                    "city"=>"active",
                    "data"=>$CityModelData,
                    "state_list"=>$state_list
                );
                return view("admin/city/edit", $data);
            }
    }

    public function delete($id){
        $session = session();
        try {
            $CityModel = new CityModel();
            $CityModel->delete($id);
            $session->setFlashdata("err","City has been Deleted");
            return redirect()->route("admin/city");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/city");
        }
    }

}
