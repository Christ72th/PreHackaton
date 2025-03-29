<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <title> Connexion - FreeLance Manager</title>
</head>
<body>
    
    <header class="header">
        <nav class="navigation">
            <div class="logo">
                <img src="../img/LogoHackaton.png" alt="Logo Freelance Manager">
                <h1>Freelance Manager</h1>
            </div>
        </nav>
    </header>
        <form action="" method="post">
            <h1>Connexion</h1>
            <div class="align">
                <label for="Username">Nom d'utilisateur : </label>
                <input type="text" id="Username" name="Username">
            </div>
            <div class="align">
                <label for="Password">Mot de passe : </label>
                <input type="password" id="Password" name="Password">
            </div>
                <div class="alert">Identifiant ou Mot de passe erroné </div>
            <button type="reset">Reinitialiser</button>
            <button type="submit">Connexion</button>
            <div class="ReinitialiserCode">
                <p><a href="reinitialiserCode.php">Code oublie ? Reinitialiser</a></p>
            </div>
            <div class="inscription">
                <p><a href="InscriptionFreelance.html">Pas encore de compte ? S'inscrire</a></p>
            </div>
        </form>
</body>
</html>


<?php
session_start();
    include('../include/connexionbd.php');
    $user="";
    $password="";
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
        $user = $_POST['Username'];
        $password = $_POST['Password'];
        try {
            $stmt1 = $conn->prepare("SELECT u.nom_utilisateur, mot_de_passe FROM freelances s, utilisateurs u WHERE u.nom_utilisateur= :nom_utilisateur AND u.nom_utilisateur=s.nom_utilisateur AND mot_de_passe=:mot_de_passe");
            $stmt1->bindParam(":nom_utilisateur",$_POST['Username']);
            $stmt1->bindParam(":mot_de_passe",$_POST['Password']);
            $stmt1->execute();
        } catch (PDOException $e) {
            $e->getMessage();
        }
        if($stmt1->rowCount()>0){
            while ($row = $stmt1->fetch()) {
                $user1 =$row['nom_utilisateur'];
                $password1=$row['mot_de_passe'];
                if($user!=$user1 || empty($user1)){
                    echo'<style>.alert {opacity: 1 !important;}</style>';
                }
                else if($password !=$password1){
                    echo'<style>.alert {opacity: 1  !important;}</style>';
                }
                else{
                    $_SESSION['Username']=$user1;
                    header('location:Accueil.php');
                }
            }
        }
        else{
            echo'<style>.alert {opacity: 1 !important;}</style>';
        }
    }

?>