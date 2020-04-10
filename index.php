<?php

/*$page = isset($_GET["page"])? $_GET["page"] : "home";

    switch ($page) {
        case "home":
            $include = "index.php";
            break;
        case "login":
            $include = "login.php.php";
            break;
        case "registration":
            $include = "registration.php";
            break;
        default : $include = "index.php";
    }*/

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

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
		
		if ((strlen($password1)<3) || (strlen($password1)>20))
		{
			$all_ok=false;
			$_SESSION['e_password']="Your password must be between 3 and 20 characters long!";
		}
		
		if ($password1!=$password2)
		{
			$all_ok=false;
			$_SESSION['e_password']="Two passwords do not match";
		}	

        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
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
        <form action="index.php" method="POST">

            <label for="name">Nom : <br><input type="text" name="nom"/></label><br>
            <label for="name2">Prénom : <br><input type="text" name="prenom"/></label><br>
            <label for="email">E-mail : <br><input type="text" name="email"/></label><br>
            <label for="pseudo">Pseudo : <br><input type="text" name="pseudo"/></label><br>
            <label for="password">Mot de passe : <br><input type="password" name="password" value="<?php
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
            <label for="password2">Répétez votre mot de passe : <br> <input type="password" value="<?php
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

            <label for="name">Pseudo :<br> <input type="text" name="login"/></label><br>
            <label for="password">Mot de passe :<br><input type="password" name="password"/></label><br><br>
            <input type="submit" value="Connectez-vous"/>

        </form>
    </div>

</body>
</html>