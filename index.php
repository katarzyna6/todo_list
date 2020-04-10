<?php

class Utilisateurs {
    
    protected $nom;
    protected $prenom;
    protected $email;
    protected $pseudo;
    protected $password;

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

    public function getPassword($password) {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $_POST["password"];
    }
}

$utilisateur1 = new Utilisateurs("", "");



$json = fopen("utilisateurs.json", "a++");
fwrite($json, json_encode($_POST));
fclose($json);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <h1>HELLO !</h1>
    <hr>
        <h2>Inscrivez-vous</h2>
<div>
    <form action="index.php" method="POST">

        <label for="name">Nom: <br><input type="text" name="nom"/></label><br>
        <label for="name2">Prénom: <br><input type="text" name="prenom"/></label><br>
        <label for="email">E-mail : <br><input type="text" name="email"/></label><br>
        <label for="pseudo">Pseudo: <br><input type="text" name="pseudo"/></label><br>
        <label for="password">Mot de passe: <br><input type="password" name="password"/></label><br><br>
        <label for="password2">Répétez votre mot de passe: <br><input type="password2" name="password2"/></label><br>
        <input type="submit" value="Créer un compte"/>

    </form>
</div>

<h2>Connectez-vous</h2>
<div>
    <form action="index.php" method="POST">

        <label for="name">Pseudo:<br> <input type="text" name="login"/></label><br>
        <label for="password">Mot de passe:<br><input type="password" name="password"/></label><br><br>
        <input type="submit" value="Connectez-vous"/>

    </form>
</div>

</body>
</html>