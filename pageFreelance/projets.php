<?php
session_start();


if (!isset($_SESSION['Username'])) {
    header('Location: ../index.html');
    exit;
}

include('../include/connexionbd.php');
include('../include/generer.php');
$sql = "SELECT 
            p.titre,
            p.descriptions,
            p.url_images,
            u.nom_utilisateur AS nomUtilisateur
        FROM 
            Projets p
        JOIN 
            Utilisateurs u ON p.nom_utilisateur_f = u.nom_utilisateur";
try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(array());
    }
} catch (PDOException $e) {
    echo json_encode(array('error' => "Erreur lors de la récupération des projets : " . $e->getMessage()));
    exit();
}
$conn = null;
?>
