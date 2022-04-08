<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/manga.php';

    $database = new Database();
    $db = $database->getConnexion();

    $items = new Manga($db);

    $stmt = $items->getManga();
    $itemCount = $stmt->rowCount();


    if($itemCount > 0){
        
        $MangaArr = array();
       
        $MangaArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nom" => $nom,
                "auteur" => $auteur,
                "illustration" => $illustration,
                "nbr_tomes" => $nbr_tomes,
                "adaptation_anime" => $adaptation_anime,
                "nbr_episodes" => $nbr_episodes,
                "nbr_saisons" => $nbr_saisons,


            );

            array_push($MangaArr, $e);
        }
        echo json_encode($MangaArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucune ressources n'a été trouvée.")
        );
    }
?>