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
            ->select("apartment.*, city.url as city, city.name as city_name")
            ->join("city", "city.id = apartment.city", "left")
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
                $data['more_information'] = json_encode($data['more_information']);
                $data['property_summary'] = json_encode($data['property_summary']);
                $data['nearby_place'] = json_encode($data['nearby_place']);
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
                    $data['url'] = url_title($data['title'], '-', true);
                    $data['specification'] = json_encode($data['specification']);
                    $data['more_information'] = json_encode($data['more_information']);
                    $data['property_summary'] = json_encode($data['property_summary']);
                    $data['nearby_place'] = json_encode($data['nearby_place']);
                    $data['video'] = $this->uploadFile("video", "backend/img/apartment/video/", $ApartmentModelData['video']);

                    if(isset($data['old_gallery'])){
                        $data['gallery'] = $this->uploadFileMultiple("gallery", "backend/img/apartment/image/", $data['old_gallery']);
                    }else {
                        $data['gallery'] = $this->uploadFileMultiple("gallery", "backend/img/apartment/image/");
                    }

                    unset($data['old_gallery']);
                    $ApartmentModel->save($data);
                    $session->setFlashdata("msg","Apartment updated successfully");
                    return redirect()->route("admin/apartment");
                }catch (\Exception $e){

                    $session->setFlashdata("err","Error : ".$e->getMessage());
                    return redirect()->back();
                }
                return redirect()->route("admin/apartment");
            }else {

                $city_list = (new CityModel)->orderBy("name", "asc")->findAll();
                $data = array(
                    "apartment"=>"active",
                    "data"=>$ApartmentModelData,
                    "city_list"=>$city_list,
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

    private function uploadFileMultiple(string $input_name, $path, array $old_image_name=[])
    {

        $files = $this->request->getFiles();
        $file_names = [];
        if($files[$input_name][0]->getName() !== "")  {
            foreach ($files[$input_name] as $file) {
                $name = $file->getRandomName();
                array_push($file_names, $name);
                $file->move($path, $name);
            }
            $file_names = array_merge($file_names, $old_image_name);
        }else {
            $file_names = $old_image_name;
        }
        return json_encode($file_names, JSON_UNESCAPED_SLASHES);
    }



}
