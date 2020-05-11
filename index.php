<?php

require_once "conf/global.php";

session_start();
var_dump($_SESSION);

spl_autoload_register(function ($class) {
    if(file_exists("models/$class.php")) {
        require_once "models/$class.php";
    }
}); //Enregistre une fonction en tant qu'implémentation de __autoload()

setcookie('pseudo', 'adam1', time() + 182 * 24 * 60 * 60, '/');
//var_dump($_COOKIE);


if (isset($_COOKIE['pseudo'])){
	$myPseudo = $_COOKIE['pseudo'];
}


$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";
//Le router analyse la requête utilisateur et en fonction de celle-ci choisi l'action à effectuer

    switch ($route) {
    case "home": $include = showHome();
    break;
    case "membre": $include = showMembre();
    break;
    case "insert_user" : insertUser();
    break;
    case "connect_user" : connectUser();
    break;
    case "deconnect" : deconnectUser();
    break;
    case "insert_tache" : insertTache();
    break;
    default : $include = showHome();  
}

function showMembre() {

    // Visualiser temporairement les données d'un utilisateur
    $user = new Utilisateur();
    $user->selectAll();

    return "membre.php";
}

function showHome() {
    if(isset($_SESSION["utilisateur"])) {
        header("Location:index.php?route=membre");
    }
    return "home.html";
}

function insertUser() {

    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["pseudo"]) && $_POST["password"] === $_POST["password2"]) {

        $user = new Utilisateur();
        $user->setNom($_POST["nom"]);
        $user->setPrenom($_POST["prenom"]);
        $user->setEmail($_POST["email"]);
        $user->setPseudo($_POST["pseudo"]);
        $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));

        $user->saveUser();

    }
    
    header("Location:index.php");

    setcookie('pseudo', $_POST['pseudo'], time() + 182 * 24 * 60 * 60, '/');   
}

function connectUser() {

    if(!empty($_POST["pseudo"]) && !empty($_POST["password"])) {

        $user = new Utilisateur();
        $user->setPseudo($_POST["pseudo"]);
        $new = $user->verifyUser()?? false;
        var_dump($new);

        if($new) {
            if(password_verify($_POST["password"], $new->password)) {
                $_SESSION["utilisateur"] = $new;
            }
        }
    } 
        header("Location:index.php");
}

function deconnectUser() {
    unset($_SESSION["utilisateur"]);
    header("Location:index.php");
}

function insertTache() {

    if(!empty($_POST["description"]) && !empty($_POST["date_limite"])) {

        $tache = new Tache();
        $tache->setDescription($_POST["description"]);
        $tache->setDateLimite($_POST["date_limite"]);

        $tache->saveTache();
    }
    
    header("Location:membre.php");  
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


</body>
</html>