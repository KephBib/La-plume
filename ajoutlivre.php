<?php
    include('db.php');  
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $titre = mysqli_real_escape_string($conn,$_POST["titre"]);
            $category = mysqli_real_escape_string($conn,$_POST["category"]);
            $subcategory = mysqli_real_escape_string($conn,$_POST["subcategory"]);
            $isbn = $_POST["isbn"];
            $auteur = mysqli_real_escape_string($conn,$_POST["auteur"]);
            $editeur = mysqli_real_escape_string($conn,$_POST["editeur"]);
            $prix = $_POST["prix"];
            $stock = $_POST["stock"];
            $description = mysqli_real_escape_string($conn,$_POST["description"]);
                
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = file_get_contents($_FILES['image']['tmp_name']);
                $images = mysqli_real_escape_string($conn, $image);    
            }

            $requete = "INSERT INTO livres (titre, categorie, sous_categorie, image, isbn, auteur, editeur, prix, stock, description) VALUES ('$titre', '$category', '$subcategory', '$images', '$isbn', '$auteur', '$editeur', '$prix', '$stock', '$description')";
            $resultat = mysqli_query($conn, $requete);
            if ($resultat) {
                header("Location: admin.php");
                exit();
            } else {
                echo "<h1 style='color:red;'>Erreur lors de l'insertion</h1><br>";
            }        
        }
?>
