<?php

class Utilisateurs {
    protected $id_utilisateur;
    protected $pseudo;
    protected $password;
}

$utilisateur = "";
$json = "";
foreach($utilisateur as &$perso) {
    $perso = ["pseudo" => $perso[0], "password" => $perso[1]];
} 


$json = fopen("utilisateurs.json", "w");
fwrite($json, json_encode(["utilisateurs" => $utilisateurs]));
fclose($json);

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];

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

<div id="login">
    <div class="titre">
        <h2>Création du compte</h2>
</div>

    <form action="index.php" method="POST">

        <label for="name">Pseudo: <br><input type="text" name="login"/></label><br><br>
        <label for="password">Mot de passe: <br><input type="password" name="password"/></label><br><br>
        <input type="submit" value="Créer un compte"/>

    </form>
</div>

</body>
</html>