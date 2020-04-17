<?php
session_start();
var_dump($_SESSION);

require "models/Utilisateur.php";

setcookie('pseudo', 'adam1', time() + 182 * 24 * 60 * 60, '/');
//var_dump($_COOKIE);
$myPseudo = $_COOKIE['pseudo'];

if (isset($_COOKIE['pseudo'])){
	$myPseudo = $_COOKIE['pseudo'];
}


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
    default : $include = showHome();  
}

function showHome() {
    if(isset($_SESSION["utilisateur"])) {
        header("Location:index.php?route=membre");
    }
    return "home.html";
}

function showMembre() {
    return "membre.php";
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

function connectUser() {

    if(!empty($_POST["pseudo"]) && !empty($_POST["password1"])) {

        $user = new Utilisateur();
        $user->setPseudo($_POST["pseudo"]);
        $new = $user->verifyUser()?? false;
        //var_dump($new);

        if($new) {
            if(password_verify($_POST["password1"], $new->password1)) {
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