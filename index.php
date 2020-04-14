<?php

setcookie('pseudo', 'adam1', time() + 182 * 24 * 60 * 60, '/');
var_dump($_COOKIE);
$myPseudo = $_COOKIE['pseudo'];

if (isset($_COOKIE['pseudo'])){
	$myPseudo = $_COOKIE['pseudo'];
}


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

    require "utilisateurs.php";
    $utilisateur1 = new Utilisateurs("", "");
    

    $json = fopen("utilisateurs.json", "a++");
    fwrite($json, json_encode($_POST));
    fclose($json);

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

    <div class = "form2">
    <h2>Connectez-vous</h2>
    
        <form action="index.php" method="POST">
            
            <label for="pseudo"><input type="text" placeholder="Pseudo" name="pseudo"/></label>
            <label for="password"><input type="password" placeholder="Mot de passe" name="password"/></label>
            <input type="submit" value="Connectez-vous"/>
            <h3><a href="registration.php">Creer un compte</a><h3>

        </form>
    </div>

</body>
</html>