<?php
session_start();
include('../include/connexionbd.php');

function getFreelanceProjectCountsByStatus($conn, $username) {
    try {
        $stmt = $conn->prepare("SELECT COUNT(CASE WHEN p.statut = 'en_cours' THEN p.id_projet END) AS nombre_projets_en_cours, COUNT(CASE WHEN p.statut = 'termine' THEN p.id_projet END) AS nombre_projets_termines FROM projets p INNER JOIN utilisateurs u ON p.nom_utilisateur_f = u.nom_utilisateur WHERE u.roles = 'freelance' AND u.nom_utilisateur = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de base de données : " . $e->getMessage());
        return null;
    }
}

function getUnreadMessageCount($conn, $username) {
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM messages WHERE utilisateur_destinataire = :username AND lu = 0");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Erreur de base de données : " . $e->getMessage());
        return 0;
    }
}

if (!isset($_SESSION['Username'])) {
    header('Location: ../index.html');
    exit;
}

$username = $_SESSION['Username'];
$projectCounts = getFreelanceProjectCountsByStatus($conn, $username, 'en_cours');
if ($projectCounts) {
    $projetsEnCours = $projectCounts['nombre_projets_en_cours'];
} else {
    echo "Impossible de récupérer le nombre de projets.";
}

$projectCounts = getFreelanceProjectCountsByStatus($conn, $username, 'termine');
if ($projectCounts) {
    $projetsTermines = $projectCounts['nombre_projets_termines'];
} else {
    echo "Impossible de récupérer le nombre de projets.";
}

$nouveauxMessages = getUnreadMessageCount($conn, $username);

try {
    $stmt = $conn->prepare("SELECT * FROM projets WHERE nom_utilisateur_f = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur de base de données : " . $e->getMessage());
    $projets = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Freelance</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
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
            <div class="NavLinks">
            <ul>
                    <li><a href="Accueil.php"><img src="../img/Accueil.svg" alt="." class="icone">Tableau de Bord</a></li>
                    <li><a href="projets.html">Projets</a></li>
                    <li><a href="#" id="parametresBtn"><img src="../img/parametre.svg" alt="." class="icone">Paramètres</a></li>
                    <li><a href="../deconnexion.php"><img src="../img/Deconnexion.svg" alt="." class="icone">Déconnexion</a></li>
                </ul>
            </div>
            <img src="../img/menuHamburger.png" alt="Menu Hamburger" class="Menu-Hamburger">
        </nav>
    </header>

    <main class="main-content">
        <section class="tableau-de-bord">
            <div class="container">
                <h2>Tableau de Bord</h2>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-tasks"></i> Projets en Cours</h5>
                                <p class="card-text"><?php echo $projetsEnCours; ?> projets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-check-circle"></i> Projets Terminés</h5>
                                <p class="card-text"><?php echo $projetsTermines; ?> projets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-envelope"></i> Nouveaux Messages</h5>
                                <p class="card-text"><?php echo $nouveauxMessages; ?> messages</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="projets-recents">
                    <h3><i class="fas fa-project-diagram"></i> Mes Projets</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom du Projet</th>
                                <th>Date de Début</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($projets)) : ?>
                                <tr><td colspan="4">Aucun projet enregistré</td></tr>
                            <?php else : ?>
                                <?php foreach ($projets as $projet) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($projet['titre']); ?></td>
                                        <td><?php echo htmlspecialchars($projet['date_debut']); ?></td>
                                        <td><?php echo htmlspecialchars($projet['statut']); ?></td>
                                        <td>
                                            <a href="projet_details.php?id=<?php echo htmlspecialchars($projet['id_projet']); ?>"><i class="fas fa-eye"></i> Voir</a> |
                                            <a href="commenter.php?id=<?php echo htmlspecialchars($projet['id_projet']); ?>"><i class="fas fa-comment"></i> Commenter</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="deposer-projet">
                    <h3><i class="fas fa-plus-circle"></i> Déposer un Projet</h3>
                    <a href="deposer_projet.html" class="btn btn-primary"><i class="fas fa-upload"></i> Déposer un Nouveau Projet</a>
                </div>
            </div>
        </section>

        <div id="parametresModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Paramètres</h2>
                <ul>
                    <li><a href="parametre.html"><i class="fas fa-user-edit"></i> Modifier le profil</a></li>
                    <li><a href="parametre.html"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a href="parametre.html"><i class="fas fa-shield-alt"></i> Sécurité</a></li>
                    <li><a href="parametre.html"><i class="fas fa-file-alt"></i> Ajouter/Modifier CV</a></li>
                </ul>
            </div>
        </div>
    </main>

    <script src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>