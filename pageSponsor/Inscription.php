<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
    <link rel="stylesheet" href="Inscription.css">
    <title>Inscription Sponsor</title>
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
            <div class="inscr-sponsor">

                <div class="img-inscr">
                    <img src="conn1.jpg" alt="Image de connexion">
                </div>
                <div class="form">


                    <form action="Traitement-inscription.php" method="post">
                        <?php
                        session_start();

                        if (isset($_SESSION['error_messages']) && !empty($_SESSION['error_messages'])) {
                            echo "<div style='color:red; position: absolute; margin: 1em 0 0 0;'>";
                            foreach ($_SESSION['error_messages'] as $error) {
                                echo "<p>$error</p>";
                            }
                            echo "</div>";
                            unset($_SESSION['error_messages']);
                        }
                        ?>
                        <h1>Inscription</h1>
                        <h1>Inscription</h1>
                        <label for="Nom" class="label1">Nom : </label>
                        <input type="text" id="Nom" name="Nom">
                        <label for="Prenom" class="label2">Prenom : </label>
                        <input type="text" name="Prenom" id="Prenom">

                        <label for="DateNaissance" class="label3">Date de naissance : </label>
                        <input type="date" id="DateNaissance" name="DateNaissance">

                        <label for="VilleResidence" class="label4">Ville de residence :</label>
                        <input type="text" id="VilleResidence" name="VilleResidence">

                        <label for="Numero" class="label5">Numero de téléphone : </label>
                        <input type="number" id="Numero" name="Numero">

                        <label for="Email" class="label6">Email : </label>
                        <input type="email" id="Email" name="Email">

                        <label for="Username" class="label7">Nom d'utilisateur : </label>
                        <input type="text" id="Username" name="Username">

                        <label for="Password" class="label8">Mot de passe : </label>
                        <input type="password" id="Password" name="Password">
                        <input type="submit" id="bouton" value="Inscription">
                        <p>Vous avez déjà un compte ? <a href="Connexion.php">Connectez-vous</a></p>
                    </form>
                </div>

            </div>
        </section>
    </main>


</body>

</html>