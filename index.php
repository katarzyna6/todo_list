<?php

$page = isset($_GET["page"])? $_GET["page"] : "home";

    switch ($page) {
        case "home":
            $include = "";
            break;
        case "login":
            $include = "";
            break;
        case "registration":
            insert_user();
            break;
        default : $include = "index.php";
    }

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

class Taches {

}

$utilisateur1 = new Utilisateurs("", "");



$json = fopen("utilisateurs.json", "a++");
fwrite($json, json_encode($_POST));
fclose($json);

//password
session_start();

function insert_user() {


$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
		
		if ((strlen($password1)<3) || (strlen($password1)>20))
		{
			$all_ok=false;
			$_SESSION['e_password']="<span style='color:red'>Your password must be between 3 and 20 characters long!</span>";
		}
		
		if ($password1!=$password2)
		{
			$all_ok=false;
			$_SESSION['e_password']="<span style='color:red'>Two passwords do not match</span>";
		}	

        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
    }
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

    <div class = "form1">
    <h2>Inscrivez-vous</h2>
        <form action="index.php?page=registration" method="POST">

            <label for="name"><input type="text" placeholder="Nom" name="nom"/></label><br>
            <label for="name2"><input type="text" placeholder="Prénom" name="prenom"/></label><br>
            <label for="email"><input type="text" placeholder="E-mail" name="email"/></label><br>
            <label for="pseudo"><input type="text" placeholder="Pseudo" name="pseudo"/></label><br>
            <label for="password"><input type="password" placeholder="Mot de passe" name="password" value="<?php
             if(isset($_SESSION['fr_password1']))
             {
                 echo $_SESSION['fr_password1'];
                 unset($_SESSION['fr_password1']);
             }
            ?>" name="password1"/></label>
        <?php 
            if(isset($_SESSION['e_password'])) {
                echo '<div class="error">'.$_SESSION['e_password'].'</div>';
                unset($_SESSION['e_password']);
            } 
        ?>
            <label for="password2"><input type="password" placeholder="Répétez le mot de passe" value="<?php
            if(isset($_SESSION['fr_password2']))
            {
                echo $_SESSION['fr_password2'];
                unset($_SESSION['fr_password2']);
            }
            ?>" name="password2"/></label>

            <input type="submit" value="Créer un compte"/>

        </form>
    </div>


    <div class = "form2">
    <h2>Connectez-vous</h2>
        <form action="index.php" method="POST">

            <label for="name"><input type="text" placeholder="Pseudo" name="login"/></label><br>
            <label for="password"><input type="password" placeholder="Mot de passe" name="password"/></label><br><br>
            <input type="submit" value="Connectez-vous"/>

        </form>
    </div>

</body>
</html>