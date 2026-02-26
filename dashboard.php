 
 <link rel="stylesheet" href="../css/style_client.css">
<section class="container">
    <h2 style="color:var(--blue)">Mon espace client</h2>

    <div class="dashboard">
        <!-- Infos perso (petit bloc) -->
        <div class="card infos">
            <h3>Mes informations</h3>

            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="tel" placeholder="Téléphone" required>
                <input type="text" name="adresse" placeholder="Adresse">

                <button class="btn btn-primary">Modifier</button>
            </form>
        </div>

        <!-- Suivi colis (grand bloc) -->
        <div class="card colis">
            <h3>Suivi de mes colis</h3>
            <ul>
                <li>📦 Paris → Casablanca | <strong>En transit</strong></li>
                <li>📦 Lyon → Marrakech | <strong>Livré</strong></li>
            </ul>

            <a href="reserve.html" class="btn btn-primary">
                Envoyer un nouveau colis
            </a>
        </div>
    </div>
</section>
 

