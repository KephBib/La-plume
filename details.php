<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Death Note</title>
    <style>
        .livre-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            gap: 20px;
        }
        .livre-image {
            max-width: 250px;
            height: auto;
        }
        .livre-details {
            flex-grow: 1;
        }
        .livre-titre {
            color: #333;
            margin-bottom: 10px;
        }
        .livre-info {
            color: #666;
            margin: 5px 0;
        }
        .livre-prix {
            font-size: 1.5em;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- header --> 
    <script>    
         fetch('header.html')
            .then(response => response.text())
            .then(data => {
               document.body.insertAdjacentHTML('afterbegin', data);
            });
    </script>
    <!-- header end --> 

    <?php
    // Paramètres de connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $motdepasse = "";
    $base_de_donnees = "la_plume";

    // Créer une connexion
    $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Erreur de connexion : " . $connexion->connect_error);
    }

    // Requête pour récupérer les détails du livre Death Note
    $id_livre = 129;
    $requete = "SELECT * FROM livres WHERE id_livre = $id_livre";
    $resultat = $connexion->query($requete);

    if ($resultat->num_rows > 0) {
        $livre = $resultat->fetch_assoc();
        ?>
        <div class="livre-container">
            <img src="assets\images\couvertures\deathnote.webp" alt="<?php echo htmlspecialchars($livre['titre']); ?>" class="livre-image">
            <div class="livre-details">
                <h1 class="livre-titre"><?php echo htmlspecialchars($livre['titre']); ?></h1>
                <p class="livre-info">Auteurs : <?php echo htmlspecialchars($livre['auteur']); ?></p>
                <p class="livre-info">Catégorie : <?php echo htmlspecialchars($livre['categorie']); ?></p>
                <p class="livre-info">Sous-catégorie : <?php echo htmlspecialchars($livre['sous_categorie']); ?></p>
                <p class="livre-info">ISBN : <?php echo htmlspecialchars($livre['isbn']); ?></p>
                <p class="livre-prix"><?php echo number_format($livre['prix'], 2, ',', ' '); ?> €</p>
            </div>
        </div>
        <?php
    } else {
        echo "<p>Aucun livre trouvé avec cet identifiant.</p>";
    }

    // Fermer la connexion
    $connexion->close();
    ?>

    <!-- footer -->
    <script>
         fetch('footer.html')
            .then(response => response.text())
            .then(data => {
               document.body.insertAdjacentHTML('beforeend', data);
            });
    </script>
    <!-- footer end -->
</body>
</html>