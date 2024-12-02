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
        
        <!-- Section pour afficher les messages -->
        <?php
        include('db.php');
        if (isset($_GET['status'])): ?>
            
            <div class="status-message <?php echo htmlspecialchars($_GET['status']); ?>">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <form action="process-payment.php" method="POST">
            <!-- Section Informations Carte Bancaire -->
            <div class="form-section">
                <h2>Carte Bancaire</h2>
                <label for="card-name">Nom sur la carte</label>
                <input type="text" id="card-name" name="card-name" required>

                <label for="card-number">Numéro de la carte</label>
                <input type="text" id="card-number" name="card-number" required maxlength="19">

                <label for="expiry-date">Date d'expiration</label>
                <input type="month" id="expiry-date" name="expiry-date" required>

                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required maxlength="3">
            </div>

            <!-- Section Adresse de Livraison -->
            <div class="form-section">
                <h2>Adresse de Livraison</h2>
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" required>

                <label for="city">Ville</label>
                <input type="text" id="city" name="city" required>

                <label for="postal-code">Code Postal</label>
                <input type="text" id="postal-code" name="postal-code" required maxlength="5">

                <label for="country">Pays</label>
                <select id="country" name="country" required>
                    <option value="france">France</option>
                    <option value="belgium">Belgique</option>
                    <option value="switzerland">Suisse</option>
                </select>
            </div>

            <button type="submit">Payer Maintenant</button>
        </form>
    </div>
</body>
</html>