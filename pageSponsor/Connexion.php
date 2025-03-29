<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Connexion.css">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
    <title>Connexion Sponsor</title>
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
    <main class="main">
        <section class="section">
            <div class="conn-sponsor">

                <div class="img-connexion">
                    <img src="conn2.jpg" alt="Image de connexion"> 
                </div>
                <div class="form">
                    <h1>Connexion</h1>

                    <?php
                    session_start();
                    if (isset($_SESSION['error_message'])) {
                        echo "<p style='color:red; margin: 0;'>" . $_SESSION['error_message'] . "</p>";
                        unset($_SESSION['error_message']);
                    }
                    ?>

                    <form action="Traitement-connexion.php" method="post">
                        <label for="Username" class="label1">Nom d'utilisateur : </label>
                        <input type="text" id="Username" name="Username" required>
                        <label for="Password" class="label2">Mot de passe : </label>
                        <input type="password" id="Password" name="Password" required>
                        <input type="submit" id="bouton" value="Connexion">
                        <p class="p1">Vous n'avez pas de compte ? <a href="Inscription.php">Inscrivez-vous</a></p>
                    </form>
                </div>

            </div>
        </section>
    </main>

</body>

</html>