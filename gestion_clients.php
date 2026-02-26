<?php
// LE VIGILE : Sécurité Admin
// if (!isset($_SESSION["connecte"]) || $_SESSION["role"] !== "admin") {
//     header("Location: index.php?view=login");
//     die("");
// }

// On récupère la liste des clients
$lesClients = getClients();
?>

<section class="container">
    <h2>Gérer les Clients Inscrits</h2>
    <p>Consultez la liste de vos clients ou supprimez les comptes inactifs.</p>

    <?php if ($msg = valider("msg")) echo "<p style='color: green; font-weight: bold;'>$msg</p>"; ?>

    <div class="card" style="margin-top: 30px;">
        <h3>👤 Liste des clients (<?php echo count($lesClients); ?>)</h3>
        
        <table style="width: 100%; margin-top: 15px; border-collapse: collapse;">
            <thead>
                <tr style="background-color: var(--bleu-primary); color: white;">
                    <th style="padding: 10px; text-align: left;">ID</th>
                    <th style="padding: 10px; text-align: left;">Nom & Prénom</th>
                    <th style="padding: 10px; text-align: left;">Email</th>
                    <th style="padding: 10px; text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($lesClients)): ?>
                    <tr><td colspan="4" style="text-align: center; padding: 15px;">Aucun client enregistré.</td></tr>
                <?php else: ?>
                    <?php foreach ($lesClients as $client): ?>
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo $client['id']; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><strong><?php echo htmlspecialchars($client['nom'] . ' ' . $client['prenom']); ?></strong></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;"><?php echo htmlspecialchars($client['email']); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #eee; text-align: right;">
                                <a href="controleur.php?action=SupprimerClient&id=<?php echo $client['id']; ?>" class="btn btn-sm btn-danger" style="background: #dc3545; color: white; padding: 5px 10px; text-decoration: none;" onclick="return confirm('Attention : Voulez-vous vraiment supprimer ce client et tout son historique ?');">
                                    🗑️ Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
