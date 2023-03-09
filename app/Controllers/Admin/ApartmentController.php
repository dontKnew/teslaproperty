<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ApartmentModel;
use App\Models\CityModel;


class ApartmentController extends BaseController
{
    public function index()
    {
        $result_number  = 15;
        if($this->request->getPostGet()){
            $result_number = $this->request->getVar("result_number");
        }
        $ApartmentModel = new ApartmentModel();
        $BookingForm = $ApartmentModel->orderBy("id", "DESC")
            ->paginate($result_number);
        $pager['pagination'] = $ApartmentModel->pager->getDetails();
        $pager['pagination']['path'] = $ApartmentModel->pager->getPageURI();
        $pager['pagination']['get_last_page'] = $ApartmentModel->pager->getLastPage();

        $data = array(
            "apartment"=>"active",
            "data"=>$BookingForm,
            "pager"=>$pager,
            'apartmentCount'=>count($ApartmentModel->findAll()),
        );

        return view("admin/apartment/index", $data);
    }

    public function add(){

        if($this->request->getPostGet()){
            $session = session();
            try {

                $data = $this->request->getVar();
                $data['url'] = url_title($data['title'], '-', true);
                $data['specification'] = json_encode($data['specification']);
                $data['gallery'] = $this->uploadFileMultiple("gallery", "backend/img/apartment/image/");
                $data['video'] = $this->uploadFile("video", "backend/img/apartment/video/");


                $ApartmentModel = new ApartmentModel();
                $ApartmentModel->save($data);
                $session->setFlashdata("msg","Apartment add successfully");
                return redirect()->route("admin/apartment");
            }catch (\Exception $e){
                $session->setFlashdata("err","Error : ".$e->getMessage());
                return redirect()->back();
            }
            return redirect()->route("admin/apartment");
        }
        $data['city_list'] = (new CityModel)->orderBy("name", "asc")->findAll();
        return view("admin/apartment/add", $data);
    }

    public function update($id){
            $session = session();
            $ApartmentModel = new ApartmentModel();
            $ApartmentModelData= $ApartmentModel->find($id);
            if($this->request->getPostGet()){
                try {
                    $data = $this->request->getVar();
                    $data['id'] = $id;

                    $ApartmentModel->save($data);
                    $session->setFlashdata("msg","Apartment updated successfully");
                    return redirect()->route("admin/apartment");
                }catch (\Exception $e){
                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/apartment");
            }else {
                $data = array(
                    "apartment"=>"active",
                    "data"=>$ApartmentModelData
                );
                return view("admin/apartment/edit", $data);
            }
    }

    public function delete($id){
        $session = session();
        try {
            $ApartmentModel = new ApartmentModel();
            $ApartmentModel->delete($id);
            $session->setFlashdata("err","Apartment has been Deleted");
            return redirect()->route("admin/apartment");
        }catch(\Exception $e){
            $session->setFlashdata("err","Error : ".$e->getMessage());
            return redirect()->route("admin/apartment");
        }
    }

    private function uploadFile(string $input_name, $path, $old_image_name=null)
    {
        if (isset($_FILES[$input_name]['name']) && $_FILES[$input_name]['name'] !== "") {
            $file = $this->request->getFile($input_name);
            $randomName = $file->getRandomName();
            $file->move($path, $randomName);
            @unlink($path . "/" . $old_image_name);
            return $randomName;
        } else {
            return $old_image_name;
        }
    }

    private function uploadFileMultiple(string $input_name, $path, $old_image_name=null)
    {
        $files = $this->request->getFiles();
        $file_names = [];
        foreach ($files[$input_name] as $file) {
            $name = $file->getRandomName();
            array_push($file_names, $name);
            $file->move($path, $name);
        }
        return json_encode($file_names, JSON_UNESCAPED_SLASHES);
    }



}
