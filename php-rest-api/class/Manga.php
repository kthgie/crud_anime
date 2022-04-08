<?php
    class Manga{

        // Connection
        private $connect;

        // Table
        private $db_table = "mangas";

        // Columns
        public $id;
        public $nom;
        public $auteur;
        public $illustration;
        public $nbr_tomes;
        public $adaptation_anime;
        public $nbr_episodes;
        public $nbr_saisons;



        // Db connection
        public function __construct($db){
            $this->connect = $db;
        }

        // GET ALL
        public function getManga(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->connect->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createManga(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nom = :nom,
                        auteur = :auteur,
                        illustration = :illustration,
                        nbr_tomes = :nbr_tomes,
                        adaptation_anime = :adaptation_anime,
                        nbr_episodes = :nbr_episodes,
                        nbr_saisons = :nbr_saisons";

        
            $stmt = $this->connect->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->auteur=htmlspecialchars(strip_tags($this->auteur));
            $this->illustration=htmlspecialchars(strip_tags($this->illustration));
            $this->nbr_tomes=htmlspecialchars(strip_tags($this->nbr_tomes));
            $this->adaptation_anime=htmlspecialchars(strip_tags($this->adaptation_anime));
            $this->nbr_episodes=htmlspecialchars(strip_tags($this->nbr_episodes));
            $this->nbr_saisons=htmlspecialchars(strip_tags($this->nbr_saisons));

        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":auteur", $this->auteur);
            $stmt->bindParam(":illustration", $this->illustration);
            $stmt->bindParam(":nbr_tomes", $this->nbr_tomes);
            $stmt->bindParam(":adaptation_anime", $this->adaptation);
            $stmt->bindParam(":nbr_episodes", $this->nbr_episodes);
            $stmt->bindParam(":nbr_saisons", $this->nbr_saisons);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getOneManga(){
            $sqlQuery = "SELECT
                         id,
                         nom,
                         auteur,
                         illustration,
                         nbr_tomes,
                         adaptation_anime,
                         nbr_episodes,
                        nbr_saisons
            
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = :id
                    LIMIT 0,1";

            $stmt = $this->connect->prepare($sqlQuery);

            //$stmt->bindParam(1, $this->id);

            $stmt->execute([':id'=>$this->id]);
            //echo $this->id;
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
           
            
            $this->nom = $dataRow['nom'];
            $this->auteur = $dataRow['auteur'];
            $this->illustration = $dataRow['illustration'];
            $this->nbr_tomes = $dataRow['nbr_tomes'];
            $this->adaptation_anime = $dataRow['adaptation_anime'];
            $this->nbr_episodes = $dataRow['nbr_episodes'];
            $this->nbr_saisons = $dataRow['nbr_saisons'];

        }        

        // UPDATE
        public function updateManga(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                     SET
                                
                                nom = :nom,
                                auteur = :auteur,
                                illustration = :illustration,
                                nbr_tomes = :nbr_tomes,
                                adaptation_anime = :adaptation_anime,
                                nbr_episodes = :nbr_episodes,
                                nbr_saisons = :nbr_saisons
      
                    WHERE 
                        id = :id";
        
            $stmt = $this->connect->prepare($sqlQuery);
        
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->auteur=htmlspecialchars(strip_tags($this->auteur));
            $this->nbr_tomes=htmlspecialchars(strip_tags($this->nbr_tomes));
            $this->adaptation_anime=htmlspecialchars(strip_tags($this->adaptation_anime));
        
            // bind data
            $stmt->bindParam(":id", $this->id);

            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":auteur", $this->auteur);
            $stmt->bindParam(":illustration", $this->illustration);
            $stmt->bindParam(":nbr_tomes", $this->nbr_tomes);
            $stmt->bindParam(":adaptation_anime", $this->adaptation);
            $stmt->bindParam(":nbr_episodes", $this->nbr_episodes);
            $stmt->bindParam(":nbr_saisons", $this->nbr_saisons);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteManga(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->connect->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

