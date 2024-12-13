<?php

namespace App\Controllers;
use Cloudinary\Cloudinary;
use Cloudinary\Uploader;
use Cloudinary\Api\Upload\UploadApi;
class Upload extends BaseController
{
    public function upload(){
        $file = $this->request->getFile('file');
    
        $title = $this->request->getVar('title');
        $description = $this->request->getVar('description');
        $genre = $this->request->getVar('genre');
        $director = $this->request->getVar('director');
        $release_date = $this->request->getVar('release-date');
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
            'img' => $mongoImageUrl,
            'title' => ucwords(trim($title)),
            'description' => $description,
            'genre' => $genre,
            'director' => $director,
            'release_date' => $release_date,

        ];
      
        //
        $client = service("curlrequest",
        ['baseURI'=> 'http://localhost:5000/']); 
 
        $response = $client->post('insert',[
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            "body" => json_encode($data),
            ]);
        $data = json_decode($response->getBody());
        return redirect()->to(base_url().'home');
         
    }
    
}
