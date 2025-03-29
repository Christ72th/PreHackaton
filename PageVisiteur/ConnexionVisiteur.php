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
                <label for="Email">Email : </label>
                <input type="text" id="Email" name="Email">
            </div>
            <button type="reset">Reinitialiser</button>
            <button type="submit">Connexion</button>
            <div class="ReinitialiserCode">
                <p><a href="../php/choixInscription.php">Souhaitez-Vous Changer le type de compte? S'Incrire</a></p>
            </div>
            <div class="inscription">
                <p><a href="../php/choixConnexion.php">Souhaitez-Vous Changer le type de compte? Connexion</a></p>
            </div>
        </form>
</body>
</html>


<?php
    include('../include/connexionbd.php');
    $email="";
    if (isset($_POST['Email'])) {
        $email = $_POST['Email'];
        try {
            $role = "freelance";
            $stmt1=$conn->prepare("INSERT INTO visiteurs(email) VALUES (:email)");
            $stmt1->bindParam(":email",$_POST['Email']);
        
            if($stmt1->execute()){
                header('location:Accueil.html');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>