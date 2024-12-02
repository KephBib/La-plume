<?php
    include('db.php');    
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $adminprenom = $_POST["adminprenom"];
            $adminnom = $_POST["adminnom"];
            $adminemail = $_POST["adminemail"];
            $adminpassword = password_hash($_POST["adminpassword"], PASSWORD_ARGON2I);

            $requet = "SELECT email FROM administrateurs WHERE email = '$adminemail'";
            $result= mysqli_query($conn, $requet);

            if (mysqli_num_rows($result) > 0) {
                echo"<h1 style='color:red;'>Cet email est déjà utilisé. Veuillez choisir un autre.</h1><br><br><br>";
            } else {

                $requete = "INSERT INTO administrateurs (nom, prenom, email, mdp, role) VALUES ('$adminprenom', '$adminnom', '$adminemail', '$adminpassword', 'admin')";
                $resultat = mysqli_query($conn, $requete);
                if ($resultat) {
                    header("Location: superadmin.php");
                    exit();
                } else {
                    echo "<h1 style='color:red;'>Erreur lors de l'insertion</h1><br><br><br>";
                }
            }           
        }
                
?>