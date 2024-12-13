<?php
namespace App\Controllers;
use Config\Encryption;
use CodeIgniter\I18n\Time;

class Login extends BaseController{
     public function index(){
         return view('login');
     }

    //  public function LoginUser(){
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');
    //     $client = service("curlrequest", [
    //         "baseURI" => "http://localhost:5000",
    //     ]);
    //     $response = $client->get("/user/getData");
    //     $data = json_decode($response->getBody(),true);
    //     foreach($data as $key => $value){
    //           //print_r($value['email']); 
    //           //echo $password;
    //           $dcrypt = password_verify($password,$value['password']);        
    //           //print_r($dcrypt);
    //           //     print_r($v
    //           //     print_r($value['email']);
    //         if($value['email'] == $email &&  $dcrypt){
    //             print_r($value['email']);
    //             session()->set('user', $email);
    //             // print_r(session()->get('user'));
    //              return redirect()->to(base_url("/home"));
    //         }else{
    //             session()->setFlashData("error","Invalid Email or Password") ;
    //             return view('login');
    //         }
    //     }
        
    //  }

public function LoginUser () {
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $client = service("curlrequest", [
        "baseURI" => "http://localhost:5000",
    ]);
    $response = $client->get("/user/getData");
    $data = json_decode($response->getBody(), true);
    //print_r($data);
    //
    $time = new Time('now','Asia/Kolkata','en_IN');
    $value = [
        'email' => $email,
        'login' => (string)$time,
        "logout" => " "
    ];

    $response2 = $client->post("/log/create",([
        "headers" =>[
            'Content-Type' => 'application/json',
        ],
        "body" => json_encode($value),
    ]));
    $data2 = json_decode($response2->getBody(),true);
    //print_r($data2);    
     foreach ($data as $user) {
        //echo $user['email'];
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            session()->set(['user'=>$user['email'], 'role'=>$user['role'] ,'logId'=>$data2['_id']]);
            return redirect()->to(base_url("/home"));
        }
    }
    session()->setFlashData("error", "Invalid Email or Password");
    return view('login');
}
//  }

  public function logout() {
    $time = new Time('now',"Asia/Kolkata","en_IN" );
    $id = session()->get('logId');
    $data = ["logout"=>(string)$time];
    $client = service("curlrequest", [
        "baseURI" => "http://localhost:5000",
    ]);
    $response = $client->put("/log/$id",([
        "headers" =>[
            'Content-Type' => 'application/json',
        ],
        "body" => json_encode($data),
    ]));
    session()->destroy();
    return redirect()->to(base_url("/"));
  }
}
?>