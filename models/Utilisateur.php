<?php

// La classe instancie un nouvel utilisateur. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base

class Utilisateur extends DbConnect {
    
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $pseudo;
    private $password;

    // Le construct permet d'établir une structure de notre utilisateur
    function __construct($id_utilisateur = null) {
        parent::__construct($id_utilisateur);
    }

    // Permet d'inserer un utilisateur dans la base de donnée.
    function insert(){
        $query = "INSERT INTO Utilisateur ('nom', 'prenom', 'email', 'pseudo', 'password')
            VALUES(:nom, :prenom, :email, :pseudo, :password)";

        $result = $this->pdo->prepare($query);
        $result = bindValue(':nom', $this->nom, PDO::PARAM_STR);
        $result = bindValue(':prenom', $this->prenom, PDO::PARAM_STR);
        $result = bindValue(':email', $this->email, PDO::PARAM_STR);
        $result = bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $result = bindValue(':password', $this->password, PDO::PARAM_STR);
        $result->execute();

        $this->id = $this->pdo->lastInsertId();
        return $this;
        
    }
    
    // Permet de modifier un utilisateur dans la base de donnée. 
    function update(){
        $query ="UPDATE * FROM utilisateur WHERE pseudo ='$this->pseudo',";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $data = $result->fetch();
                //appel aux setters de l'objet
            return $this;
    }

    // Permet de supprimer un utilisateur dans la base de donnée. 
    function delete(){
        $query ="DELETE * FROM utilisateur WHERE pseudo ='$this->pseudo',";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $data = $result->fetch();
            //appel aux setters de l'objet
        return $this;
    }
       
    // Permet de selectionner un utilisateurs dans la base de donnée.
    function select(){
        $query2 = "SELECT * FROM utilisateur WHERE id_utilisateur = $this->idUtilisateur;";
        $result2 = $this->pdo->prepare($query2);
        $result2->execute();
        $data2 = $result2->fetch();
            //appel aux setters de l'objet
        return $this;
    }

    public function selectByPseudo() {
        $query2 = "SELECT * FROM utilisateur WHERE pseudo = '$this->pseudo';";
        $result2 = $this->pdo->prepare($query2);
        $result2->execute();
        $data2 = $result2->fetch();
                //appel aux setters de l'objet
         return $data2;
        }
        
    }


    // Permet de selectionner tous les utilisateurs dans la base de donnée. 
    function selectAll() {
        $query = "SELECT * FROM Utilisateur;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas = $result->fetchAll(); //fetch->récupérer les resultats dans un tableau
        $tab = [];
        var_dump($datas);
    }//La méthode selectAll() (correspondant à la propriété read de la méthode CRUD) 
    //va nous permettre de récupérer toutes les données enregistrées dans une table.

    // La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    function getIdUtilisateur ($id_utilisateur) {
        $this->idUtilisateur = $id_utilisateur;
    }

    // La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
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

    

    /* Permet d'enregistrer un utilisateur en encodant le fichier json. Unique permet de vérifier si le pseudo et le password existe déja ou non.
    
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

    // Permet de vérifier si un utilisateur est dans le fichier json. 
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