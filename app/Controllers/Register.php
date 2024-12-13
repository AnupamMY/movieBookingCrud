<?php

namespace App\Controllers;
use Config\Encryption;

class Register extends BaseController
{
    public function index()
    {
        return view('Register');
    }

    public function registerUser(){
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getVar("confirmpassword");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'email' => $email,
            'password' => $hash, 
        ];
        
        if($password != $cpassword){
            session()->setFlashData("error","Password and Confirm Password does not Match") ;
            return view('Register');
        }else{
            $client = service("curlrequest", [
                "baseURI" => "http://localhost:5000",
            ]);
            $response = $client->post("/user/register", [
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            "body" => json_encode($data),
            ]);
            if($response->getStatusCode() == 200){
                return redirect()->to(base_url("/"));
            }else{
                session()->setFlashData("error","Email Already Exists") ;
                return view('Register');            
            }
        }
    }  
}

?>