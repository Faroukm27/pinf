<link rel="stylesheet" href="../css/style_client.css">
<div class="container hero">
    <div style="flex: 1;">
        <h2>Contactez TransMaroc2i</h2>
        <p>Une question sur un envoi ? Besoin d'un devis spécifique ? Écrivez-nous directement.</p>
        
        <div style="margin: 20px 0;">
            <a href="https://wa.me/33771134629" target="_blank" class="btn btn-success" style="background-color: #25D366; border: none; color: white;">
                💬 Discuter sur WhatsApp
            </a>
        </div>
        
        <hr style="margin: 20px 0;">

        <?php if ($msg = valider("msg")) echo "<p style='color: green; font-weight: bold;'>$msg</p>"; ?>
        <?php if ($erreur = valider("erreur")) echo "<p style='color: red; font-weight: bold;'>$erreur</p>"; ?>

        <form action="controleur.php" method="POST" style="max-width: 500px;">
            <input type="hidden" name="action" value="EnvoyerMessageContact">
            
            <div class="form-group">
                <label for="nom">Votre Nom / Entreprise :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            
            <div class="form-group">
                <label for="email">Votre Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="message">Votre Message :</label>
                <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Envoyer le message</button>
        </form>
    </div>
</div>