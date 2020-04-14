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

            <label for="name"><input type="text" placeholder="Nom" name="nom"/></label>
            <label for="name2"><input type="text" placeholder="Prénom" name="prenom"/></label>
            <label for="email"><input type="text" placeholder="E-mail" name="email"/></label>
            <label for="pseudo"><input type="text" placeholder="Pseudo" name="pseudo"/></label>
            <label for="password1"><input type="password" placeholder="Mot de passe" name="password1" value="<?php
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
            <h3><a href="index.php">Retour</a><h3>

        </form>
    </div>
</body>
</html>