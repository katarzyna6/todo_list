<?php
    // On requiert le fichier utilisateurs.php pour permettre d'ajouter les informations utilisateurs à nos taches
    require 'Utilisateur.php';

    // La classe instancie une nouvelle tache. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
    // Elle requiert les méthodes afin d'agrémenter la base

class Tache extends DbConnect {

    protected $id_tache;
    protected $description;
    protected $date_limite;
    protected $id_utilisateur;

    // Le construct permet d'établir une structure de notre tache
    function __construct($id=null) {
        parent::__construct($id);
    }

    // La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
    // La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }

    public function getIdTache($id_tache) {
        return $this->id_tache;
    }

    public function setIdTache($id_tache) {
        $this->id_tache = $_POST["tache"];
    }

    public function getDescription($description) {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $_POST["description"];
    }

    public function getDateLimite($date_limite) {
        return $this->date_limite);
    }

    public function setDateLimite($date_limite) {
        $this->date_limite = $_POST["date_limite"];
    }  

    // Permet d'enregistrer une tache en encodant le fichier json. 
    function saveTache() {

        $tab = json_decode(file_get_contents("datas/taches.json"));

        $unique = true;
        foreach($tab as $element) {
            if($element->pseudo == $this->pseudo) {
                $unique = false;
            }
        }

        $tache = [
            "id_tache" => sizeof($tab) + 1,
            "description" => $this->description,
            "date_limite" => $this->date_limite
            
        ];

        if($unique) {
            array_push($tab, $tache);
            $taches_json = json_encode($tab);
            file_put_contents("datas/taches.json", $taches_json);
        }
    }

    

   // Permet d'inserer une tache dans la base de donnée.
   public function insert(){
    var_dump($this);
    $query1 = "INSERT INTO tache (DESCRIPTION,DATE_LIMITE, ID_UTILISATEUR) VALUES ('$this->description','$this->date', $this->idUtilisateur)";
    $result1 = $this->pdo->prepare($query1);
    $result1->execute();
    $id2 = $this->pdo->lastInsertId();
    var_dump($this);
    return $this;

}

    // Permet de selectionner toutes les taches dans la base de donnée. 
    public function selectAll(){
    $query ="SELECT * FROM tache;";
    $result = $this->pdo->prepare($query);
    $result->execute();
    $datas= $result->fetchAll();

    $tab=[];

    foreach($datas as $data) {
        $current = new Tache();
        $current->setId($data['ID_TACHE']);
        array_push($tab, $current);
        }
        return $tab;

    }

    // Permet de selectionner une tache dans la base de donnée. 
    public function select(){
        $query2 = "SELECT * FROM tache WHERE ID_TACHE = $this->idTache;";
        $result2 = $this->pdo->prepare($query2);
        $result2->execute();
        $data2 = $result2->fetch();
        //appel aux setters de l'objet
        return $this;
}

    // Permet de modifier une tache dans la base de donnée. 
    public function update(){
        $query ="UPDATE * FROM tasks WHERE ID_TASK = $this->idTache;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $data = $result->fetch();
                //appel aux setters de l'objet
            return $this;
    }

    // Permet de supprimer une tache dans la base de donnée. 
    public function delete(){
        $query ="DELETE * FROM tache WHERE ID_TACHE = $this->idTache;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $data = $result->fetch();
        //appel aux setters de l'objet
        return $this;
    }
}

?>
