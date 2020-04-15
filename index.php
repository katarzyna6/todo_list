<?php

require "models/Utilisateur.php";

setcookie('pseudo', 'adam1', time() + 182 * 24 * 60 * 60, '/');
var_dump($_COOKIE);
$myPseudo = $_COOKIE['pseudo'];

if (isset($_COOKIE['pseudo'])){
	$myPseudo = $_COOKIE['pseudo'];
}


$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";

    switch ($route) {
    case "home": $include = showHome();
    break;
    case "insert_user" : insertUser();
    break;
    default : $include = showHome();  
}

function showHome() {
    return "home.html";
}

function insertUser() {

    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["pseudo"]) && $_POST["password1"] === $_POST["password2"]) {

        $user = new Utilisateur();
        $user->setNom($_POST["nom"]);
        $user->setPrenom($_POST["prenom"]);
        $user->setEmail($_POST["email"]);
        $user->setPseudo($_POST["pseudo"]);
        $user->setPassword1(password_hash($_POST["password1"], PASSWORD_DEFAULT));

        $user->saveUser();

    }
    

    header("Location:index.php");


    setcookie('pseudo', $_POST['pseudo'], time() + 182 * 24 * 60 * 60, '/');   
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

    <?php require "views/$include"; ?>

    <!-- <div class = "form2">
    <h2>Connectez-vous</h2>
    
        <form action="index.php" method="POST">
            
            <label for="pseudo"><input type="text" placeholder="Pseudo" name="pseudo"/></label>
            <label for="password"><input type="password" placeholder="Mot de passe" name="password"/></label>
            <input type="submit" value="Connectez-vous"/>
            <h3><a href="registration.php">Creer un compte</a><h3>

        </form>
    </div> -->

</body>
</html>