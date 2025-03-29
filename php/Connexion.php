<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="LogoHackaton.png" type="image/x-icon">
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
    <div class="card">
        <form action="" method="post">
            <h1>Connexion</h1>
            <div class="align">
                <label for="Username">Nom d'utilisateur : </label>
                <input type="text" id="Username" name="Username">
            </div>
                <div class="alert"> Utilisateur non present </div>
            <div class="align">
                <label for="Password">Mot de passe : </label>
                <input type="password" id="Password" name="Password">
            </div>
                <div class="alert">Mot de passe erroné </div>
            <button type="reset">Reinitialiser</button>
            <button type="submit">Connexion</button>
            <div class="ReinitialiserCode">
                <p><a href="reinitialiserCode.php">Code oublie ? Reinitialiser</a></p>
            </div>
            <div class="inscription">
                <p><a href="inscription.php">Pas encore de compte ? S'inscrire</a></p>
            </div>
        </form>
    </div>
</body>
</html>


<?php
    $user="";
    $password="";
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
        $user = $_POST['Username'];
        $password = $_POST['Password'];
    }
    else{
        echo'<style>.alert {opacity: 0 !important;}</style>';
    }
    if($user!='users'){
        echo'<style>.alert {opacity: 1 !important;}</style>';
    }
    else if($password !='1234'){
        echo'<style>.alert {opacity: 1  !important;}</style>';
    }
    else{
        header('location:Accueil.html');
    }

?>