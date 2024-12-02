<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_ARGON2I);

    $requet = "SELECT email FROM clients WHERE email = '$email'";
    $result=mysqli_query($conn,$requet);

    if ($result->num_rows > 0) {
        $erreur = "Cet email est déjà utilisé. Veuillez choisir un autre.";
    } else {
        $requete = "INSERT INTO clients (nom, prenom, email, mdp) VALUES ('$nom', '$prenom','$email', '$pwd')";
        $resultat=mysqli_query($conn,$requete);
        if ($resultat) {
            header("Location: connecter.php");
            exit();
        } else {
            $erreur = "Erreur lors de la création du compte. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - La Plume</title>
    <link rel="stylesheet" href="css/style1.css"> 
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>       
        <?php
        include 'db.php'; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $pwd = password_hash($_POST['pwd'], PASSWORD_ARGON2I);

            $requet = "SELECT email FROM clients WHERE email = '$email'";
            $result=mysqli_query($conn,$requet);

            if ($result->num_rows > 0) {
                $erreur = "Cet email est déjà utilisé. Veuillez choisir un autre.";
            } else {
                $requete = "INSERT INTO clients (nom, prenom, email, mdp) VALUES ('$nom', '$prenom','$email', '$pwd')";
                $resultat=mysqli_query($conn,$requete);
                if ($resultat) {
                    header("Location: connecter.php");
                    exit();
                } else {
                    echo"<p class='error-message'>Erreur lors de la création du compte, veuillez réessayer</p>";
                }
            }
        }
        ?>
        <form method="post" action="creercompte.php">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" required>
            
            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" id="prenom" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="pwd">Mot de passe:</label>
            <input type="password" name="pwd" id="pwd" required>
            
            <button type="submit">S'inscrire</button>
        </form>
        
        <p>Déjà inscrit ? <a href="connecter.php">Se connecter</a></p> <!-- Lien vers la page de connexion -->
    </div>
</body>
</html>
