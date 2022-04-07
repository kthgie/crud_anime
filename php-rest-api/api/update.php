<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require_once '../config/database.php';
    require_once '../class/manga.php';
    
    $database = new Database();
    $db = $database->getConnexion();
    
    $item = new Manga($db);
    
    $data = json_decode(file_get_contents("php://input"));
    var_dump($data);
    
    $item->id = $data->id;
    
    // manga values
    $item->nom = $data->nom;
    $item->auteur = $data->auteur;
    $item->illustration = $data->illustration;
    $item->nbr_tomes = $data->nbr_tomes;
    $item->adaptation_anime = $data->adaptation_anime;
    $item->nbr_episodes = $data->nbr_episodes;
    $item->nbr_saisons = $data->nbr_saisons;


    
    if($item->updateManga()){
        echo json_encode(" manga data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>