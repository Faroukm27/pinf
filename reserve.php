 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver un envoi</title>
     <link rel="stylesheet" href="../css/style_client.css">
</head>
<body>

<section class="container">
    <div class="card">
        <h2 style="color:var(--blue)">Réserver un envoi</h2>

        <form>
            <select>
                <option>Ville de départ (France)</option>
                <option>Paris</option>
                <option>Lyon</option>
            </select>

            <select>
                <option>Ville d’arrivée (Maroc)</option>
                <option>Casablanca</option>
                <option>Marrakech</option>
            </select>

            <input type="text" placeholder="Type de colis">
            <input type="number" placeholder="Poids (kg)">
            <textarea placeholder="Commentaire (optionnel)"></textarea>

            <button class="btn btn-primary">Envoyer ma demande</button>
        </form>
    </div>
</section>

</body>

 
</html>
