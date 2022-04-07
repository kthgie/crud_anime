<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/manga.php';
    
    $database = new Database();
    $db = $database->getConnexion();
    
    $item = new Manga($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    if($item->deleteManga()){
        echo json_encode("Supprimé.");
    } else{
        echo json_encode("Problème perçu lors de la suppression");
    }
?>