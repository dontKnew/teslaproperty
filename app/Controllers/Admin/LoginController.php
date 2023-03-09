<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\AdminModel;

class LoginController extends BaseController
{
    private $attempt_msg = null;
    public function index()
    {
        if(session()->has("logged_in")){
            return redirect()->route("admin/dashboard");
        }else {
            return view('admin/login');   
        }
    }

    public function changePassword(){
        if($this->request->getMethod()=="post"){
            $session = session();
            $id = $session->get('id');
            $password = $this->request->getVar('password');
            $cpassword = $this->request->getVar('cpassword');

            if($password == $cpassword){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $model = new AdminModel();
                try {
                    if($model->update($id, array("password"=>$password))){
                        $session->setFlashdata('msg', 'Password has been changed');
                    }else {
                        $session->setFlashdata('err', 'Password could not change');
                    }
                    return redirect()->route('admin/change-password');
                }catch(Exception $e){
                    $session->setFlashdata('err', 'Error :'.$e->getMessage());
                    return redirect()->route('admin/change-password');
                }

            }else {
                $session->setFlashdata('err', 'Please enter same password');
                return redirect()->route('admin/change-password');
            }

        }
        return view("admin/profile/change_password");
    }

    public function adminProfile(){
        
        
        $session = session();
        $id = $session->get('id');
        $admin = new AdminModel();
        $data = $admin->find($id);
        return view("admin/profile/profile",["data"=>$data, "profile"=>"active"]);
    }

    public function updateProfile(){
        if($this->request->getMethod()=="post"){
            $session = session();
            $id = $session->get('id');
            $model = new AdminModel();
            $oldData  =$model->find($id);
            try {
                $data = $this->request->getVar();
                $image = $this->updateImage("profile", $oldData['profile'], "backend/img/admin_profile/" );
                $data['profile'] = $image;
                $_SESSION['profile'] = $image;
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $data['email'];
                if($model->update($id, $data)){
                    $session->setFlashdata('msg', 'Your profile is updated');
                }else {
                    $session->setFlashdata('msg', 'Profile could not update');
                }
                return redirect()->route('admin/profile');

            }catch(Exception $e){
                $session->setFlashdata('msg', 'Error :'.$e->getMessage());
                return redirect()->route('admin/profile');
            }
        }
    }

    public function adminLogout()
    {
        $session = session();
        $session->destroy();
        return redirect()->route('admin/login');
    }

    public function updateImage(string $input_name, $old_image_name, $path)
    {
        if ($_FILES[$input_name]['name'] !== "") {
            /*check image is valid or not*/
            $validationRule = [
                $input_name => [
                    'rules' => 'uploaded[' . $input_name . ']'
                        . '|is_image[' . $input_name . ']'
                        . '|mime_in[' . $input_name . ',image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                ],
            ];
            if (!$this->validate($validationRule)) {
                echo "Please uploaded valid image";
                exit;
            } else {
                $realName = pathinfo($_FILES[$input_name]['name'], PATHINFO_FILENAME);
                $file = $this->request->getFile($input_name);
                $randomName = $file->getRandomName();
                $name = $realName . "_" . $randomName;
                $file->move($path, $name);
                if (file_exists($path . "/" . $old_image_name)) {
                    unlink($path . "/" . $old_image_name);
                }
                return $name;
            }
        } else {
            return $old_image_name;
        }
    }

    public function adminLogin()
    {

        $session = session();
        $model = new AdminModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Get user data from database
        $user = $model->where('email', $email)->first();

        // Check if user exists
        if (!$user) {
            $session->setFlashdata('msg', 'This email is not registered');
            return redirect()->route('admin/login');
        }

        // Check if account is locked
        if (strtotime($user['last_login']) > time()) {
            $timeRemaining = strtotime($user['last_login']) - time();
            $session->setFlashdata('msg', "Your account is locked for " . round($timeRemaining / 60) . " minutes.");
            return redirect()->route("admin/login");
        }

        // Check if password is correct
        if (!password_verify($password, $user['password'])) {
            $maxAttempts = 3;
            $remainingAttempts = $maxAttempts - $user['login_attempt'] - 1;
            $remainingAttemptsText = $remainingAttempts == 1 ? '1 attempt' : "$remainingAttempts attempts";
            $session->setFlashdata('msg', "Incorrect password. You have $remainingAttemptsText remaining before your account is locked.");
            $this->incrementLoginAttempt($user['id'], $user['login_attempt']); // increment login attempt count
            if ($user['login_attempt'] + 1 >= $maxAttempts) {
                $this->lockAccount($user['id']);
                $session->setFlashdata('msg', "Your account has been locked for due to too many failed login attempts.");
            }
            return redirect()->route("admin/login");
        }

        // Login successful
        $sessionData = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'profile' => $user['profile'],
            'logged_in' => TRUE
        ];
        $session->set($sessionData);
        $this->resetLoginAttempts($user['id']); // reset login attempt count
        return redirect()->route('admin/dashboard');
    }

    private function incrementLoginAttempt($id, $count){
        (new AdminModel)->save(array("id"=>$id, "login_attempt"=>$count+1));
    }
    private function lockAccount($id){
        $lock_time = date("Y-m-d H:i:s", strtotime("+24 hours"));
        (new AdminModel)->save(array("id"=>$id, "last_login"=>$lock_time));
    }
    private function resetLoginAttempts($id){
        (new AdminModel)->save(array("id"=>$id, "login_attempt"=>0));
    }



}
