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
    case "home": $view = showHome();//Afficher la page d'accueil avec mon formulaire 
    break;
    case "membre": $view = showMembre();//Afficher l'espace membre pour un utilisateur connecté 
    break;
    case "insert_user" : insertUser();// Déclencher une action-> enregistrer un nouvel utilisateur puis de rappeler ma page d'accueil
    break;
    case "connect_user" : connectUser();// Déclencher une action-> connecter un utilisateur puis de rediriger vers l'espace membre si OK
    break;
    case "deconnect" : deconnectUser();
    break;
    case "insert_tache" : insertTache();
    break;
    case "show_calendar" : $view = showCalendar();
    break;
    default : $view = showHome();//Afficher la page d'accueil avec mon formulaire  
}

// 3. FONCTIONS DE CONTROLE
// Actions déclenchées en fonction du choix de l'utilisateur
// 1 choix = 1 fonction avec deux "types" de fonctions, celles qui mèneront à un affichage, et celles qui seront redirigées (vers un choix conduisant à un affichage)

// Fonctionnalité(s) d'affichage :

function showMembre() {

    // Visualiser temporairement les données d'un utilisateur
    $user = new Utilisateur();
    $user->selectAll();
    $datas = [];

    return ["template" => "membre.php", "datas" => $datas];
}

function showHome() {
    if(isset($_SESSION["utilisateur"])) {
        header("Location:index.php?route=membre");
    }
    

    $datas = [];
	// il suffit désormais de mettre dans $datas les données à transmettre à notre vue
    // par exemple $datas["annee"] = 2020;
	return ["template" => "home.html", "datas" => $datas];
}

function showCalendar() {

    $aujd = new DateTimeImmutable("now", new DateTimeZone("europe/Paris"));
    $annee_courante = $aujd->format("Y");
    $mois_courant = $aujd->format("m");
    $month = new Month($mois_courant, $annee_courante);

    $datas = [
        "mois" => $month->getMonthName(),
        "annee" => $month->getYear()
    ];
    return ["template" => "calendrier.php", "datas" => $datas];
}

    

// Fonctionnalité(s) redirigées :

function insertUser() {
    
    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["pseudo"]) &&
    $_POST["password"] === $_POST["password2"]) {
      
        /*if (preg_match("#^[a-zA-Z-àâäéèêëïîôöùûüçàâäéèêëïîôöùûüçÀÂÄÉÈËÏÔÖÙÛÜŸÇæœÆŒ]+$#", $_POST["nom"])
            && preg_match("#^[a-zA-Z-àâäéèêëïîôöùûüçàâäéèêëïîôöùûüçÀÂÄÉÈËÏÔÖÙÛÜŸÇæœÆŒ]+$#", $_POST["prenom"])
            && preg_match("#^(a-z0-9)+(a-z0-9)+@(a-z0-9)+(a-z0-9)$#", $_POST["email"])
            && preg_match("# \^[a-zA-Z0-9_]{3,16}$#", $_POST["pseudo"])
            && preg_match("#^[a-zA-Z0-9]+$#", $_POST["password"]))  {*/

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

        /*}else {
                echo "Erreur.<br>";
        
        }*/
    }
    setcookie('pseudo', $_POST['pseudo'], time() + 182 * 24 * 60 * 60, '/');
    //header("Location:index.php");
}  

function connectUser() {

    if(!empty($_POST["pseudo"]) && !empty($_POST["password"])) {

        $user = new Utilisateur();
        $user->setPseudo($_POST["pseudo"]);
        $user->setPassword($_POST["password"]);
        $verif = $user->selectByPseudo();
var_dump($verif);
        if($verif) { 
                if(password_verify($_POST["password"], $verif["password"])) {
                    $_SESSION["utilisateur"] = $verif;
                    header('Location:index.php?route=membre'); 
                   
                } else { 
                    header('Location:index.php?route=home');
                } 
            
        } else {
            header('Location:index.php?route=home');
        }
    } 
    
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

        $tache->setIdUtilisateur($_SESSION['utilisateur']['id_utilisateur']);

        $tache->insert();
        var_dump($tache); 
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

    <?php require "views/{$view['template']}"; ?>


</body>
</html>