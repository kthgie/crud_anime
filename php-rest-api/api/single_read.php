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

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getOneManga();

    if($item->nom != null){
        // create array
        $emp_arr = array(
            "id" =>  $item->id,
            "nom" => $item->nom,
            "auteur" => $item->auteur,
            "illustration" => $item->illustration,
            "nbr_tomes" => $item->nbr_tomes,
            "adaptation_anime" => $item->adaptation_anime,
            "nbr_episodes" => $item->nbr_episodes,
            "nbr_saisons" => $item->nbr_saisons
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Aucune ressource n'a été trouvé.");
    }
?>