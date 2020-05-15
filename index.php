<?php

// Demarre une session utilisateur
session_start();
var_dump($_SESSION);

// On requiere le fichier global qui correspond à la base de donnée

require_once "conf/global.php";

// FRONT CONTROLLER -> Toutes les requêtes arrivent ici et sont traitées par le ROUTER
// ------------------------------------------------------------------------------------
// 1. INCLUSIONS CLASSES
// Dans un premier temps, nous allons inclure les fichiers de nos classes ici pour pouvoir les utiliser


spl_autoload_register(function ($class) {
    if(file_exists("models/$class.php")) {
        require_once "models/$class.php";
    }
});

setcookie('pseudo', 'adam1', time() + 182 * 24 * 60 * 60, '/');
//var_dump($_COOKIE);


if (isset($_COOKIE['pseudo'])){
	$myPseudo = $_COOKIE['pseudo'];
}

// 2. ROUTER
// Structure permettant d'appeler une action en fonction de la requête utilisateur
$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";


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

// 3. FONCTIONS DE CONTROLE
// Actions déclenchées en fonction du choix de l'utilisateur
// 1 choix = 1 fonction avec deux "types" de fonctions, celles qui mèneront à un affichage, et celles qui seront redirigées (vers un choix conduisant à un affichage)

// Fonctionnalité(s) d'affichage :

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

// Fonctionnalité(s) redirigées :

function insertUser() {

    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["pseudo"]) &&
    $_POST["password"] === $_POST["password2"]) {

        if (preg_match("#^[a-zA-Z-àâäéèêëïîôöùûüçàâäéèêëïîôöùûüçÀÂÄÉÈËÏÔÖÙÛÜŸÇæœÆŒ]+$#", $_POST["nom"])
            && preg_match("#^[a-zA-Z-àâäéèêëïîôöùûüçàâäéèêëïîôöùûüçÀÂÄÉÈËÏÔÖÙÛÜŸÇæœÆŒ]+$#", $_POST["prenom"])
            && preg_match("#^(a-z0-9)+(a-z0-9)+@(a-z0-9)+(a-z0-9)$#", $_POST["email"])
            && preg_match("# \^[a-zA-Z0-9_]{3,16}$#", $_POST["pseudo"])
            && preg_match("#^[a-zA-Z0-9]+$#", $_POST["password"]))  {

                $user = new Utilisateur();
                $user->setNom($_POST["nom"]);
                $user->setPrenom($_POST["prenom"]);
                $user->setEmail($_POST["email"]);
                $user->setPseudo($_POST["pseudo"]);
                $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));

                $user->insert();
                $pseudo= isset($_POST['pseudo'])? $_POST['pseudo'] : "null";
                $password= isset($_POST['password'])? $_POST['password'] : "null";
                $_SESSION['pseudo']=$pseudo;
                $_SESSION['password']=$password;

        }else {
                echo "Erreur.<br>";
        
        }
    }
    setcookie('pseudo', $_POST['pseudo'], time() + 182 * 24 * 60 * 60, '/');
    header("Location:index.php");
}  

function connectUser() {

    if(!empty($_POST["pseudo"]) && !empty($_POST["password"])) {

        $user = new Utilisateur();
        $user->setPseudo($_POST["pseudo"]);
        $user->setPassword($_POST["password"]);
        $verif = $user-SelectByPseudo();

        if($verif) {
            header('Location:index.php?route=membre');
        } else {
            header('Location:index.php?route=home');
        }
            
        /*$new = $user->verifyUser()?? false;
        var_dump($new);

        if($new) {
            if(password_verify($_POST["password"], $new->password)) {
                $_SESSION["utilisateur"] = $new;
            }
        }*/
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

<!--4. TEMPLATE
Affichage du système de templates HTML-->

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