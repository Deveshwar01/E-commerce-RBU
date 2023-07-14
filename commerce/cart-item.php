<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');
header('Access-Control-Allow-Methods: POST');

$data = json_decode(file_get_contents("php://input"), $associative=true);


if($_SERVER['REQUEST_METHOD'] === 'GET'){

     $url = $_SERVER['REQUEST_URI'];
     $query = parse_url($url);
     parse_str($query['query', $inco]);

     //assume made query to db
    $data = [
        [id= 1, "name"=> "T-shirt",
        "price"=> 1,
        "size"=> 3,
        "quatity"=> 4,
        "description"=> "This is t-shirt",
        "image"=>"images/f1.jpg"],
        [id= 2, "name"=> "T-shirt",
        "price"=> 1,
        "size"=> 3,
        "quatity"=> 4,
        "description"=> "This is t-shirt",
        "image"=>"images/f1.jpg"],

        [id= 3,"name"=> "T-shirt",
        "price"=> 1,
        "size"=> 3,
        "quatity"=> 4,
        "description"=> "This is t-shirt",
        "image"=>"images/f1.jpg"],

        [id= 4,"name"=> "T-shirt",
        "price"=> 1,
        "size"=> 3,
        "quatity"=> 4,
        "description"=> "This is t-shirt",
        "image"=>"images/f1.jpg"],

        [id= 5,"name"=> "T-shirt",
        "price"=> 1,
        "size"=> 3,
        "quatity"=> 4,
        "description"=> "This is t-shirt",
        "image"=>"images/f1.jpg"],
    ];

    //search
   foreach($data as $d){
    if($d['id'] === $inco['id']){
        http_response_code(200);
        echo json_encode($d);
        exit;
    }
   }
}
