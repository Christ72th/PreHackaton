<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background: #1362e9 !important; overflow: hidden;">
    <header class="header">
        <nav class="navigation">
            <div class="logo">
                <img src="../img/LogoHackaton.png" alt="Logo Freelance Manager">
                <h1>Freelance Manager</h1>
            </div>
            <div class="NavLinks">
                <ul>
                    <li><a href="#"><img src="../img/Accueil.svg" alt="." class="icone">Tableau de Bord</a></li>
                    <li><a href="projets.html">Projets</a></li>
                    <li><a href="#" id="parametresBtn"><img src="../img/parametre.svg" alt="." class="icone">Paramètres</a></li>
                    <li><a href="../deconnexion.php"><img src="../img/Deconnexion.svg" alt="." class="icone">Déconnexion</a></li>
                </ul>
            </div>
            <img src="../img/menuHamburger.png" alt="Menu Hamburger" class="Menu-Hamburger">
        </nav>
    </header>
    <?php
    session_start();


    if (!isset($_SESSION['Username'])) {
        header('Location: ../index.html');
        exit;
    }

    include('../include/connexionbd.php');
    $id=$_GET['id'];

        $stmt=$conn->query("SELECT * FROM projets where id_projet='$id'");
        if($stmt->rowCount()> 0){
            $i=0;
            while ($row = $stmt->fetch()) {
                $titre=$row['titre'];
                $img= $row['url_images'];
                $exe= $row['url_executable'];
                $rm= $row['url_readme'];
                $code= $row['url_code_source'];
            }
        }
    ?>
    <?php echo '<h1 style="text-align: center;"> Nom du projet : <span class="nom">'.$titre.'</span></h1>'; ?>
    <div class="container showprojet">
        <div class="cards-container" >
             <a href="<?php echo $img;?>"><div class="card col-md-6"><?php if($img==''){echo'Aucune image';}else{echo 'Cliquer ici pour voir';}?></div></a>
             <a href="<?php echo $exe;?>"><div class="card col-md-6"><?php if($exe==''){echo'Aucun fichier executable';}else{echo 'Cliquer ici pour voir';}?></div></a>
        </div>
        <div class="cards-container">              
            <a href="<?php echo $rm;?>"><div class="card col-md-6"><?php if($rm==''){echo'Aucun fichier readme';}else{echo 'Cliquer ici pour voir';}?></div></a>
            <a href="<?php echo $code;?>"><div class="card col-md-6"><?php if($code==''){echo'Aucun code source';}else{echo 'Cliquer ici pour voir';}?></div></a>

        </div>
    </div>
</body>