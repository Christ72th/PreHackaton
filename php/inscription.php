<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <title>Inscription - FreeLance Manager</title>
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
            <h1>Inscription</h1>
            <div class="align">
                <label for="Nom">Nom: </label>
                <input type="text" id="Nom" name="Nom">
            </div>
            <div class="align">
                <label for="Prenom">Prenom : </label>
                <input type="text" id="Prenom" name="Prenom">
            </div>
            <div class="align">
                <label for="DateNaissance">Date de naissance: </label>
                <input type="date" id="DateNaissance" name="DateNaissance">
            </div>
            <div class="align">
                <label for="VilleResidence">Ville de residence </label>
                <input type="text" id="VilleResidence" name="VilleResidence">
            </div>
            <div class="align">
                <label for="Numero">Numero : </label>
                <input type="text" id="Numero" name="Numero">
            </div>
            <div class="align">
                <label for="Email">Email : </label>
                <input type="text" id="Email" name="Email">
            </div>
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
            <button type="submit">Creer</button>
                <p><a href="Connexion.php">Deja un compte ? Connectez-Vous</a></p>
        </form>
    </div>

    
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
