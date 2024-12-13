<?php

namespace App\Controllers;
use Cloudinary\Cloudinary;
use Cloudinary\Uploader;
use Cloudinary\Api\Upload\UploadApi;

class Home extends BaseController
{

    

    public function index(){
       $client = service("curlrequest", [
           "baseURI" => "http://localhost:5000",
       ]);
       
       $search = $this->request->getVar('search');
       $val = ucwords(trim($search));

       $response1 = $client->get("/ticket");
       $data2["ticketPrice"] = json_decode($response1->getBody(),true);
       
       $movie['title'] = $val;

       if($val != null){
           $response = $client->get("/search",[
             "headers" => [
                 'Content-Type' => 'application/json',
             ],
             "body" => json_encode($movie),
           ]);
           $data['movies'] = json_decode($response->getBody(),true);
           return view('navbar',$data2).view('home', $data);
       }

        $response = $client->get("");
        $data['movies'] = json_decode($response->getBody(),true);
        $response2 = $client->get("/ticket");
        $data2["ticketPrice"] = json_decode($response2->getBody(),true);
        return view('navbar',$data2).view('home', $data);
    
}
    public function movieDetails($id){
        $client = service("curlrequest", [
            "baseURI" => "http://localhost:5000",
        ]);
       
            $response = $client->get("/detail/$id");
            $data['movie'] = json_decode($response->getBody());

           
            //var_dump($data);
            return view('SinglePage',$data);
       
    }


    public function updateMovie($id){
       

        $title = $this->request->getVar('title');
        $description = $this->request->getVar('description');
        
        $release_date = $this->request->getVar('release-date');
        $genre = $this->request->getVar('genre');
        $director = $this->request->getVar('director');
        $file = $this->request->getFile('file');
        // var_dump($file->getPathname());
        // var_dump($file->getName());
        
        $cloudinary = new Cloudinary([
            'cloud_name' => 'drd9sewmt',
            'api_key' => "755451695238817",
            'api_secret' => "38jZuJL6f1_WAGgsboORRqmOM7M",
            'secure' => false, 
            'verify' => false
        ]);
        
        $uploadApi = new UploadApi();
        $upload = $cloudinary->uploadApi()->upload($file->getPathname(), [
            'resource_type' => 'auto',
            'verify' => false
        ]);
        $imageUrl['url'] = $upload['url'];
        $mongoImageUrl = $upload['url'];
        
        $data = [
            "title" => $title,
            "description" =>$description,
            "release_date" => $release_date,
            "genre" =>$genre,
            "director" => $director,
            "img" => $mongoImageUrl
        ];
        
        $client = service("curlrequest",[
            "baseURI" => "http://localhost:5000",
        ]);

        $response = $client->post("/update/$id",[
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            "body" => json_encode($data),
        ]);
        return redirect()->to(base_url().'/home');
    }
   

    public function deleteMovie($id){
        $client = service("curlrequest",[
            "baseURI" => "http://localhost:5000",
        ]);
        $response = $client->delete("/delete/$id");        
        return redirect()->to(base_url("/home"));   
    } 
    

    public function bookTicket($id){
        $seat = [
          "A" => [1,2,3,4,5,6,7,8,9,10],
          "B" => [1,2,3,4,5,6,7,8,9,10],
          "C" => [1,2,3,4,5,6,7,8,9,10],
          "D" => [1,2,3,4,5,6,7,8,9,10],
          "E" => [1,2,3,4,5,6,7,8,9,10]
        ];
        $client = service("curlrequest",[
            "baseURI" => "http://localhost:5000"
        ]);
        $response = $client->get("/detail/$id");
        $data = json_decode($response->getBody());
        $occupiedSeats = $data->occupiedSeats;
        return view("bookTicket",["seat" => $seat,"id"=>$id,"occupiedSeats" => $occupiedSeats]);

    }
    public function book($id,$seat,$price){
        //$seat = $this->request->getVar('seat');
        $occupiedSeats = explode("_",$seat);
        $client = service("curlrequest",[
            "baseURI" => "http://localhost:5000"
        ]);
        $response1 = $client->get("/detail/$id");
        $data1 = json_decode($response1->getBody());
        $reseverdSeats = $data1->occupiedSeats;
        foreach($reseverdSeats as $key){
            array_push($occupiedSeats,$key);
        }
        //print_r($occupiedSeats);
        $response2 = $client->patch("updateSeats/$id",[
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            "body" => json_encode($occupiedSeats),
        ]);
        $data2 = json_decode($response2->getBody());
        //var_dump($data2);
        //print_r($data2);
        //updating data for ticket 
        $ticketData = [
            "seats" => explode("_",$seat),
            "totalprice" => $price,
            "title" => $data2->title,
            "img" => $data2->img,
            "release_date" => $data2->release_date,
            
        ];
        $ticketUrl = service("curlrequest",[
            "baseURI" => "http://localhost:5000/"
        ]);
    
    
        $response3 = $ticketUrl->post("ticket/create",[
            'headers' => [
                 'Content-Type' => 'application/json',
             ],
            "body" => json_encode($ticketData), 
        ]);

        $data3 = json_decode($response3->getBody());
        //print_r($data3);
        $tid = $data3->_id;
    return redirect()->to("/ticket/$tid");
 }
    
    

    public function ticket($id){
        
        $ticketGet = service("curlrequest",[
            "baseURI" => "http://localhost:5000/"
        ]);
        $response = $ticketGet->get("ticket/$id");
        $data["ticketPrice"] = json_decode($response->getBody(),true);
        print_r($data["ticketPrice"]); 
        return view("Ticket",["ticketPrice"=>$data["ticketPrice"]]);
    }

    public function userTicket(){
        $user = service("curlrequest",[
            "baseURI" => "http://localhost:5000/"
        ]);
        $response = $user->get("user");
        $data["user"] = json_decode($response->getBody(),true);
        return view("book",["user"=>$data["user"]]);
    }
    

    public function logs(){
        $log = service("curlrequest",[
          "baseURI" => "http://localhost:5000/",        
        ]);
        $response = $log->get("log");
        $data['log'] = json_decode($response->getBody(),true);
        //print_r($data);
        return view("log",["log"=>$data['log']]);
    }

}
