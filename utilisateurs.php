<?php

class Utilisateurs {
    
    protected $nom;
    protected $prenom;
    protected $email;
    protected $pseudo;
    protected $password1;
    protected $password2;

    public function getNom($nom) {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $_POST["nom"];
    }

    public function getPrenom($prenom) {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $_POST["prenom"];
    }

    public function getEmail($email) {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $_POST["email"];
    }

    public function getPseudo($pseudo) {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $_POST["pseudo"];
    }

    public function getPassword1($password1) {
        return $this->password1;
    }

    public function setPassword2($password2) {
        $this->password2 = $_POST["password2"];
    }
}

?>