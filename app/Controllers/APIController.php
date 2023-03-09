<?php


namespace App\Controllers;
use App\Models\BookingFormModel;
class APIController extends BaseController
{

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST");
//        header('Content-Type: application/json');

    }

    public function index()
    {
        if ($this->request->getPostGet()) {
            $data =  $this->request->getVar();
           if(isset($data['shipper'])){
               $data['shipper']['pickup_time'] = date("Y-m-d H:i:s", strtotime($data['shipper']['pickup_time']));
               $data['shipper'] = json_encode($data['shipper']);
           }
            if (isset($data['consignee'])) {
                $data['consignee'] = json_encode($data['consignee']);
            }

            if ((new BookingFormModel())->where("booking_token", $data['booking_token'])->set($data)->update()) {
                return json_encode(array("status" => 200, "message" => "Booking Form Added Successfully!"), JSON_UNESCAPED_SLASHES);
            } else {
                return json_encode(array("status" => 300, "message" => "Bad Request!"), JSON_UNESCAPED_SLASHES);
            }
        }else {
            return "hello";
        }

    }
}


