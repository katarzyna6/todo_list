<?php

class Utilisateur {
    
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $pseudo;
    private $password1;
    private $pdo;

    function __construct($id_utilisateur = null) {
        $this->pdo = new PDO (<todolist>,<katarzyna>,<testy>);
        $this->id_utilisateur = $id_utilisateur;
    }

    function setIdUtilisateur ($id_utilisateur) {
        $this->idUtilisateur = $id_utilisateur
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom(string $nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom(string $prenom) {
        $this->prenom = $prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getPassword1() {
        return $this->password1;
    }

    public function setPassword1(string $password1) {
        $this->password1 = $password1;
    }

    function saveUser() {

        $tab = json_decode(file_get_contents("datas/users.json"));

        $unique = true;
        foreach($tab as $element) {
            if($element->pseudo == $this->pseudo) {
                $unique = false;
            }
        }

        $user = [
            "id_utilisateur" => sizeof($tab) + 1,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "email" => $this->email,
            "pseudo" => $this->pseudo,
            "password1" => $this->password1
        ];

        if($unique) {
            array_push($tab, $user);
            $users_json = json_encode($tab);
            file_put_contents("datas/users.json", $users_json);
        }
    }

    function verifyUser() {
        
        $tab = json_decode(file_get_contents("datas/users.json"));
        foreach($tab as $user) {
            if($this->pseudo == $user->pseudo) {
                return $user;
            }
        }
    }
}

?>