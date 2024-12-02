<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Paiement</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <div class="payment-container">
        <h1>Informations de Paiement</h1>
        
        <!-- Section pour afficher les messages d'erreur -->
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['card-name'];
            $numero = $_POST['card-number'];
            $date_expiration = $_POST['expiry-date'];
            $cvv = $_POST['cvv'];

            // Exemple de validation simple (à adapter selon vos besoins)
            $erreurs = [];
            if (empty($nom)) {
                $erreurs[] = "Le nom sur la carte est requis.";
            }
            if (!preg_match("/^\d{16}$/", str_replace(" ", "", $numero))) {
                $erreurs[] = "Le numéro de carte doit comporter 16 chiffres.";
            }
            if (empty($date_expiration)) {
                $erreurs[] = "La date d'expiration est requise.";
            }
            if (!preg_match("/^\d{3}$/", $cvv)) {
                $erreurs[] = "Le CVV doit comporter 3 chiffres.";
            }

            if (!empty($erreurs)) {
                echo '<div class="error-messages">';
                foreach ($erreurs as $erreur) {
                    echo "<p>$erreur</p>";
                }
                echo '</div>';
            } else {
                echo '<p class="success-message">Les informations sont valides.</p>';
                // Vous pouvez ajouter ici la logique de traitement du paiement
            }
        }
        ?>

        <form action="" method="POST">
            <!-- Section Informations Carte Bancaire -->
            <div class="form-section">
                <h2>Carte Bancaire</h2>
                <label for="card-name">Nom sur la carte</label>
                <input type="text" id="card-name" name="card-name" placeholder="John Doe" required>

                <label for="card-number">Numéro de la carte</label>
                <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9101 1121" maxlength="19" required>

                <label for="expiry-date">Date d'expiration</label>
                <input type="month" id="expiry-date" name="expiry-date" required>

                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
            </div>

            <button type="submit">Payer Maintenant</button>
        </form>
    </div>
</body>
</html>
