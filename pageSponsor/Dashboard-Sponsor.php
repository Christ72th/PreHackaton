<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
    <link rel="stylesheet" href="Dashboard.css">
    <title>Tableau de Bord Sponsor</title>
</head>

<body>
    <?php
        include('../include/connexionbd.php');
        session_start();

        if (!isset($_SESSION['Username'])) {
            header('Location: ../index.html');
            exit;
        }
        $stmt1=$conn->query("SELECT count(*) as total FROM Freelances f");
        if($stmt1->rowCount()> 0){
            while ($row = $stmt1->fetch()) {
                $nbreFreelances=$row['total'];
            }
        }
    ?>

    <header class="header">
        <nav class="navigation">
            <div class="logo">
                <img src="../img/LogoHackaton.png" alt="Logo Freelance Manager">
                <h1>Freelance Manager</h1>
            </div>
        </nav>
    </header>

    <aside class="dashboard">
        <a href="#">Home</a>
        <a href="#">Dashboard</a>
        <a href="projets.php">Freelance</a>
        <a href="../deconnexion.php">Déconnexion</a>
    </aside>
    <main class="main">
        <article class="article">

        </article>
        <section class="section">
            <div class="div1">
            <a href="">
                <img src="img_analyse1.png" alt="image stat">
            </a>
            <h3>Nombre de Freelances : <?php echo $nbreFreelances;?> </h3>
            </div>
        </section>
        <section class="section2"></section>


    </main>
</body>

</html>