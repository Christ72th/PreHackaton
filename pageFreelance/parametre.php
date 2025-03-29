<?php
include('../include/connexionbd.php');
try {
    session_start();

    if (!isset($_SESSION['nom_utilisateur'])) {
        header("Location: connexion.php");
        exit();
    }

    $role = "freelance";
    $nom_utilisateur = $_SESSION['nom_utilisateur'];
    $stmt = $conn->prepare("SELECT nom, prenom, date_naissance, ville_residence, email, numero_telephone, localisation, domaine_competence, descriptions 
                            FROM Utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
    $stmt->bindParam(":nom_utilisateur", $nom_utilisateur);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn->beginTransaction();

        $stmt1 = $conn->prepare("INSERT INTO Utilisateurs (nom, prenom, date_naissance, ville_residence, nom_utilisateur,  email, numero_telephone,  localisation, domaine_competence, descriptions) 
                                VALUES (:nom, :prenom, :date_naissance, :ville_residence, :nom_utilisateur,  :email, :numero_telephone,  :localisation, :domaine_competence, :descriptions)
                                ON DUPLICATE KEY UPDATE
                                nom = :nom, prenom = :prenom, date_naissance = :date_naissance, 
                                ville_residence = :ville_residence,  email = :email, numero_telephone = :numero_telephone, 
                                localisation = :localisation, domaine_competence = :domaine_competence, descriptions = :descriptions");

        $stmt1->bindParam(":nom", $_POST['nom']);
        $stmt1->bindParam(":prenom", $_POST['prenom']);
        $stmt1->bindParam(":date_naissance", $_POST['date_naissance']);
        $stmt1->bindParam(":ville_residence", $_POST['ville_residence']);
        $stmt1->bindParam(":nom_utilisateur", $nom_utilisateur);
       
        $stmt1->bindParam(":email", $_POST['email']);
        $stmt1->bindParam(":numero_telephone", $_POST['telephone']);
        
        $stmt1->bindParam(":localisation", $_POST['localisation']);
        $stmt1->bindParam(":domaine_competence", $_POST['domaineCompetence']);
        $stmt1->bindParam(":descriptions", $_POST['description']);


        $stmt1->execute();
        $stmt2 = $conn->prepare("INSERT INTO Freelances (nom_utilisateur, numero_telephone, email, localisation, domaine_competence, description) 
                                VALUES (:nom_utilisateur, :numero_telephone, :email, :localisation, :domaine_competence, :description)
                                ON DUPLICATE KEY UPDATE 
                                numero_telephone = :numero_telephone, email = :email,  localisation = :localisation, 
                                domaine_competence = :domaine_competence, description = :description"); 

        $stmt2->bindParam(":nom_utilisateur", $nom_utilisateur);
        $stmt2->bindParam(":numero_telephone", $_POST['telephone']);
        $stmt2->bindParam(":email", $_POST['email']);
        $stmt2->bindParam(":localisation", $_POST['localisation']);
        $stmt2->bindParam(":domaine_competence", $_POST['domaineCompetence']);
        $stmt2->bindParam(":description", $_POST['description']);


        $stmt2->execute(); 

        $conn->commit();
        echo "Modification réussie";
    }


} catch (PDOException $e) {
    $conn->rollBack();
    echo "Erreur : " . $e->getMessage();
}
?>
