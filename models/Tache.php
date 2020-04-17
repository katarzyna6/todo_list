<?php
class Tache {

    protected $id_tache;
    protected $description;
    protected $date_limite;
    protected $pseudo;

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

    public function getPseudo($pseudo) {
        return $this->pseudo);
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $_POST["pseudo"];
    }   

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
}

?>