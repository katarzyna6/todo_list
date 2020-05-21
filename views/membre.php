<div class="espace">

    <h1>Mon espace</h1>

</div>

    <div class = "form3">
        <h2>Ajouter une tâche</h2>
        
            <form action="index.php?route=insert_tache" method="POST">
                
                <label for="description"><input type="text" placeholder="Description" name="description"/></label>
                <label for="date_limite"><input type="date" placeholder="Date limite" name="date_limite"/></label>
                <input type="submit" value="Ajouter"/>
                <h3><a href="index.php">Retour</a><h3>
                <h3><a href="index.php?route=deconnect">Me déconnecter</a></h3>
    
            </form>
    </div>
