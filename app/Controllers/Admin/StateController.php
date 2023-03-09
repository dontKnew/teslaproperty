<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StateModel;


class StateController extends BaseController
{
    public function index()
    {


        $result_number  = 15;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $StateModel = new StateModel();
        $State = $StateModel->orderBy("name","asc")->paginate($result_number);

        $pager['pagination'] = $StateModel->pager->getDetails();
        $pager['pagination']['path'] = $StateModel->pager->getPageURI();
        $pager['pagination']['get_last_page'] = $StateModel->pager->getLastPage();

        $data = array(
            "state"=>"active",
            "data"=>$State,
            "pager"=>$pager,
            'stateCount'=>count($StateModel->findAll())
        );

        return view("admin/state/index", $data);
    }

    public function add(){

        if($this->request->getPostGet()){
            $session = session();
            try {

                $data = $this->request->getVar();
                $data['url'] = url_title($data['name'], '-', TRUE);
                $StateModel = new StateModel();
                $StateModel->save($data);
                $session->setFlashdata("msg","State add successfully");
                return redirect()->route("admin/state");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/state");
        }
        return view("admin/state/add");
    }

    public function update($id){
            $session = session();
            $StateModel = new StateModel();
            $StateModelData= $StateModel->find($id);
            if($this->request->getPostGet()){
                try {
                    $data = $this->request->getVar();
                    $data['id'] = $id;
                    $data['url'] = url_title($data['name'], '-', TRUE);

                    $StateModel->save($data);
                    $session->setFlashdata("msg","State updated successfully");
                    return redirect()->route("admin/state");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/state");
            }else {
                $data = array(
                    "state"=>"active",
                    "data"=>$StateModelData
                );
                return view("admin/state/edit", $data);
            }
    }

    public function delete($id){
        $session = session();
        try {
            $StateModel = new StateModel();
            $StateModel->delete($id);
            $session->setFlashdata("err","State has been Deleted");
            return redirect()->route("admin/state");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/state");
        }
    }

}
