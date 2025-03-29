<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets - Freelance Manager</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="Dashboard.css">
    <link rel="shortcut icon" href="../img/LogoHackaton.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

    <aside class="dashboard">
        <a href="Dashboard-Sponsor.php">Home</a>
        <a href="Dashboard-Sponsor.php">Dashboard</a>
        <a href="#">Freelance</a>
        <a href="../deconnexion.php">Déconnexion</a>
        </aside>

    <main class="main">
        <article class="article">

        </article>

        <section class="section">
            <div class="container">
                <h2>Tous les Projets</h2>

                <div class="projets-liste">


                <?php 
                    include('../include/connexionbd.php');
                    session_start();

                    if (!isset($_SESSION['Username'])) {
                        header('Location: ../index.html');
                        exit;
                    }
                    

                    $stmt2=$conn->query("SELECT* FROM Freelances , projets  where nom_utilisateur_f= nom_utilisateur");
                    if($stmt2->rowCount()> 0){

                        while ($row = $stmt2->fetch()) {
                            $img=$row['url_images'];
                            if($img==""){
                                $img='../img/nonTrouve.png';
                            }
                            $titre= $row['titre'];
                            $id_projet= $row['id_projet'];
                            $description=$row['descriptions'];
                            $nomUtilisateur=$row['nom_utilisateur'];
                            $_SESSION['id_projet']=$row['id_projet'];
                            echo '<div class="projet-block">';
                                echo '<div class="projet">';
                                    echo '<img src="../PageFreelance/'. $img.'" alt="'.$titre.'" class="projet-image">';
                                    echo'<h3><i class="fas fa-laptop-code"></i>'.$titre.'</h3>';
                                    echo '<p>'.$description.'</p>';
                                    echo '<p>Freelance :' .$nomUtilisateur.'</p>';
                                    echo'
                            <div class="projet-actions">
                                <a href="projet_details.php?id='.$_SESSION['id_projet'].' "><i class="fas fa-eye"></i> Voir</a>
                                <a href="commenter.html"><i class="fas fa-comment"></i> Commenter</a>
                                <a href="participer.html"><i class="fas fa-handshake"></i> Participer</a>
                            </div>';
                                echo'</div>';
                            echo '</div>';
                        }
                    }
                ?>

                    <div class="projet-block">
                        <div class="projet">
                            <img src="../img/img1.jpg" alt="Projet Développement Site Web" class="projet-image">
                            <h3><i class="fas fa-laptop-code"></i> Développement Site Web</h3>
                            <p>Description du projet...</p>
                            <p>Freelance : Mr Dior</p>
                            <div class="projet-actions">
                                <a href="projet_details.html"><i class="fas fa-eye"></i> Voir</a>
                                <a href="commenter.html"><i class="fas fa-comment"></i> Commenter</a>
                                <a href="participer.html"><i class="fas fa-handshake"></i> Participer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ajouter-projet">
                    <a href="deposer_projet.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </section>

        <div id="parametresModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Paramètres</h2>
                <ul>
                    <li><a href="profil.html"><i class="fas fa-user-edit"></i> Modifier le profil</a></li>
                    <li><a href="notifications.html"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a href="securite.html"><i class="fas fa-shield-alt"></i> Sécurité</a></li>
                    <li><a href="cv.html"><i class="fas fa-file-alt"></i> Ajouter/Modifier CV</a></li>
                </ul>
            </div>
        </div>
    </main>

    <script src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript pour gérer la fenêtre modale
        var modal = document.getElementById("parametresModal");
        var btn = document.getElementById("parametresBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>