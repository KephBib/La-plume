<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - La Plume</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php 
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            $requete_client= "SELECT id_client, mdp FROM clients WHERE email = '$email'";
            $client=mysqli_query($conn,$requete_client);
            $clients = mysqli_fetch_assoc($client);

            $requete_administrateur= "SELECT id_administrateur, mdp, role FROM administrateurs WHERE email = '$email'";
            $administrateur=mysqli_query($conn,$requete_administrateur);
            $administrateurs = mysqli_fetch_assoc($administrateur);
            
            if ($clients && password_verify($mot_de_passe, $clients['mdp'])) {
                    header("Location: index.html");
                    exit();
            } elseif ($administrateurs && password_verify($mot_de_passe, $administrateurs['mdp'])){
                if ($administrateurs['role'] == 'admin') {
                    header("Location: admin.php");
                    exit();
                } elseif ($administrateurs['role'] == 'super-admin') {
                    header("Location: superadmin.php");
                    exit();
                }
            } else {
                echo"<p class='error-message'>Email ou mot de passe incorrect</p>";
            }
        }
        ?>
        <form method="post" action="connecter.php">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required>

            <button type="submit">Se connecter</button>
        </form>

        <p>Pas encore de compte ? <a href="creercompte.php">Créer un compte</a></p>
    </div>
</body>
</html>

