<link rel="stylesheet" href="css/style_global.css">
<div class="login-container">
    <h2>Connexion à TransMaroc2i</h2>

    <?php 
    // On utilise valider() pour récupérer le message passé dans l'URL par le contrôleur
    if ($msg = valider("msg")) { 
        echo "<p class='message-erreur' style='color:red;'>$msg</p>"; 
    } 
    ?>

    <form action="controleur.php" method="POST">
        <input type="hidden" name="action" value="Connexion">

        <div class="form-group">
            <label for="email">Adresse Email :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="passe">Mot de passe :</label>
            <input type="password" id="passe" name="passe" required>
        </div>

        <button type="submit" class="btn-primary">Se connecter</button>
    </form>
    
    <p>Pas encore de compte ? <a href="index.php?view=register">S'inscrire</a></p>
</div>