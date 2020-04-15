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
}

?>