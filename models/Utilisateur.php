<?php

class Utilisateur extends DbConnect {
    
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $pseudo;
    private $password;

    function __construct($id_utilisateur = null) {
        parent::__construct($id_utilisateur);
    }

    //Ajouter un nouvel utilisateur
    function insert(){
        $query = "INSERT INTO Utilisateur ('nom', 'prenom', 'email', 'pseudo', 'password')
            VALUES(:nom, :prenom, :email, :pseudo, :password)";
    //Injection SQL
        $result = $this->pdo->prepare($query);
        $result = bindValue(':nom', $this->nom, PDO::PARAM_STR);
        $result = bindValue(':prenom', $this->prenom, PDO::PARAM_STR);
        $result = bindValue(':email', $this->email, PDO::PARAM_STR);
        $result = bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $result = bindValue(':password', $this->password, PDO::PARAM_STR);

        $this->id = $this->pdo->lastInsertId();
        return $this;
        
    }
    
    function update(){
    }

    function delete(){
    }
        
    function select(){
    }

    function selectAll() {
        $query = "SELECT * FROM Utilisateur;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas = $result->fetchAll(); //fetch->récupérer les resultats dans un tableau
        $tab = [];
        var_dump($datas);
    }//La méthode selectAll() (correspondant à la propriété read de la méthode CRUD) 
    //va nous permettre de récupérer toutes les données enregistrées dans une table.

    function setIdUtilisateur ($id_utilisateur) {
        $this->idUtilisateur = $id_utilisateur;
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

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function selectByPseudo() {
        
    }

    /* ------Utilisation JSON-----------
    
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
            "password" => $this->password
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
}*/

?>