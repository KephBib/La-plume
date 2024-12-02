<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background-color: #005477;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        form {
            display: grid;
            gap: 20px;
            max-width: 800px;
        }

        .form-group {
            display: grid;
            gap: 8px;
        }

        label {
            font-weight: bold;
            color:black;
            font-size: 16px;
        }

        input, select, textarea {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        select:disabled {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .books-list{
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }

        .book-item{
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            align-items: center;
        }
        

        .search-container {
            display: flex;
            justify-content: center;
            margin: 20px;
        }
        
        .search-input {
            width: 300px;
            padding: 10px 15px;
            font-size: 16px;
            border: 2px solid #007bff;
            border-radius: 25px;
            outline: none;
        }


        .book-image {
            width: 100px;
            height: 140px;
            object-fit: cover;
            border-radius: 4px;
        }

        .book-info{
            display: grid;
            gap: 8px;
        }

        .book-actions{
            display: flex;
            gap: 10px;
        }

        .preview-image {
            max-width: 200px;
            max-height: 280px;
            margin-top: 10px;
        }

    </style>
</head>
<?php
include('db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_livre = $_POST['id_livre'] ?? ''; 
    $titre = mysqli_real_escape_string($conn, $_POST['titre'] ?? '');
    $prix = $_POST['prix'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    
    $requete_livre = "SELECT image, titre, prix, stock, description FROM livres WHERE id_livre = '$id_livre'";
    $resultat_livre = mysqli_query($conn, $requete_livre);
    if ($livre = mysqli_fetch_assoc($resultat_livre)) {
        $titre_avant = $livre['titre'];
        $prix_avant = $livre['prix'];
        $stock_avant = $livre['stock'];
        $description_avant = $livre['description'];
        
        if ($livre['image']) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($livre['image']);
            $image_avant = "data:$mimeType;base64,".base64_encode($livre['image']);
        }
    }


    if (isset($_POST['modifier'])) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = file_get_contents($_FILES['image']['tmp_name']);
            $images = mysqli_real_escape_string($conn, $image);    
        } else {
            $images = mysqli_real_escape_string($conn, $livre['image']);
        }
    
        $requete = "UPDATE livres SET 
                    titre = '$titre', 
                    prix = $prix, 
                    stock = $stock, 
                    description = '$description', 
                    image = '$images'
                    WHERE id_livre = '$id_livre'";

        try {
            $resultat = mysqli_query($conn, $requete);
            if ($resultat) {
                echo "<script>window.location.href = 'superadmin.php';</script>";
                exit();
            }
        } catch (Exception $e) {
            echo "<h3 style='color: red;'>Erreur : ".$e."</h3>";
        }
    }
}

?>

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre">Nouveau titre</label>
            <input type="text" id="titre" name="titre" value="<?php echo "$titre_avant"; ?>" required>
            <input type="hidden" name="id_livre" value="<?php echo "$id_livre"; ?>">
        </div>

        <div class="form-group">
            <label for="prix">Prix (€)</label>
            <input type="number" id="prix" name="prix" value="<?php echo "$prix_avant"; ?>" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="<?php echo "$stock_avant"; ?>" min="0" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
            <img id="imagePreview" class="preview-image" src="<?php echo "$image_avant"; ?>" alt="Aperçu de l'image">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo "$description_avant"; ?></textarea>
        </div>

        <button type="submit" name="modifier">Enregistrer les modifications</button>
    </form>
</div>
<script>
    function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
</script>
</body>
</html>
