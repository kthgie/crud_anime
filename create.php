<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Manga.php';

    $database = new Database('mangapi');
    $db = $database->getConnexion('mangapi');

    $item = new Manga($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nom = $data->nom;
    $item->auteur = $data->auteur;
    $item->illustration = $data->illustration;
    $item->nbr_tomes = $data->nbr_tomes;
    $item->adaptation_anime = $data->adaptation_anime;
    $item->nbr_episodes = $data->nbr_episodes;
    $item->nbr_saisons = $data->nbr_saisons;
    
    
    if($item->createManga()){
        echo 'Votre publication est postée.';
    } else{
        echo 'Votre publication n\'\a pas été prise en compte !.';
    }
?>