<?php
include('db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $cardName = $_POST['card-name'] ?? '';
    $cardNumber = $_POST['card-number'] ?? '';
    $expiryDate = $_POST['expiry-date'] ?? '';
    $cvv = $_POST['cvv'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $postalCode = $_POST['postal-code'] ?? '';
    $country = $_POST['country'] ?? '';

    // Simuler des validations (exemple simple)
    $orderValid = true; // Supposons que tout va bien par défaut
    $errorMessage = '';

    // Vérifications de base
    if (empty($cardName) || empty($cardNumber) || strlen($cardNumber) !== 19 || empty($expiryDate) || empty($cvv) || strlen($cvv) !== 3) {
        $orderValid = false;
        $errorMessage = "Informations de paiement invalides.";
    }

    // Simuler une vérification d'article en base de données
    $articleExists = true; // Exemple : on suppose que l'article existe
    if (!$articleExists) {
        $orderValid = false;
        $errorMessage = "Article introuvable.";
    }

    // Redirection avec un message selon le statut
    if ($orderValid) {
        header("Location: index.html?status=success&message=" . urlencode("Commande traitée avec succès."));
    } else {
        header("Location: index.html?status=error&message=" . urlencode("Commande non traitée. Veuillez recommencer. $errorMessage"));
    }
    exit;
}
?>