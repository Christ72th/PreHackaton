<?php
include('../include/connexionbd.php');

try {
    $role = "freelance";

    $conn->beginTransaction();
    $stmt1 = $conn->prepare("INSERT INTO Utilisateurs (nom, prenom, date_naissance, ville_residence, nom_utilisateur, mot_de_passe, email, numero_telephone, roles, date_inscription, localisation, domaine_competence, descriptions, photo_profil, cv) 
                            VALUES (:nom, :prenom, :date_naissance, :ville_residence, :nom_utilisateur, :mot_de_passe, :email, :numero_telephone, :roles, NOW(), :localisation, :domaine_competence, :descriptions, :photo_profil, :cv)");

    $stmt1->bindParam(":nom", $_POST['Nom']);
    $stmt1->bindParam(":prenom", $_POST['Prenom']);
    $stmt1->bindParam(":date_naissance", $_POST['DateNaissance']);
    $stmt1->bindParam(":ville_residence", $_POST['VilleResidence']);
    $stmt1->bindParam(":nom_utilisateur", $_POST['Username']);
    $stmt1->bindParam(":mot_de_passe", $_POST['Password']);
    $stmt1->bindParam(":email", $_POST['Email']);
    $stmt1->bindParam(":numero_telephone", $_POST['Numero']);
    $stmt1->bindParam(":roles", $role);
    $stmt1->bindParam(":localisation", $_POST['localisation']);
    $stmt1->bindParam(":domaine_competence", $_POST['domaine']);
    $stmt1->bindParam(":descriptions", $_POST['description']);
    $photo_profil_name = "";
    if (isset($_FILES['profil']) && $_FILES['profil']['error'] == 0) {
        $photo_profil_name = $_FILES['profil']['name'];
        $photo_profil_tmp_name = $_FILES['profil']['tmp_name'];
        $photo_profil_destination = "../uploads/" . $photo_profil_name;

        if (!is_dir("../uploads")) {
            mkdir("../uploads");
        }
        move_uploaded_file($photo_profil_tmp_name, $photo_profil_destination);
    }
    $stmt1->bindParam(":photo_profil", $photo_profil_name);

    $cv_name = "";
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $cv_name = $_FILES['cv']['name'];
        $cv_tmp_name = $_FILES['cv']['tmp_name'];
        $cv_destination = "../uploads/" . $cv_name;

        if (!is_dir("../uploads")) {
            mkdir("../uploads");
        }
        move_uploaded_file($cv_tmp_name, $cv_destination);
    }
    $stmt1->bindParam(":cv", $cv_name);

    $stmt1->execute(); 
    $stmt2 = $conn->prepare("INSERT INTO Freelances (nom_utilisateur, numero_telephone, email, localisation, domaine_competence, descriptions, cv) 
                            VALUES (:nom_utilisateur, :numero_telephone, :email, :localisation, :domaine_competence, :descriptions, :cv)");
    $stmt2->bindParam(":nom_utilisateur", $_POST['Username']);
    $stmt2->bindParam(":numero_telephone", $_POST['Numero']);
    $stmt2->bindParam(":email", $_POST['Email']);
    $stmt2->bindParam(":localisation", $_POST['localisation']);
    $stmt2->bindParam(":domaine_competence", $_POST['domaine']);
    $stmt2->bindParam(":descriptions", $_POST['description']);
    $stmt2->bindParam(":cv", $cv_name);

    $stmt2->execute(); 
echo 'ok1';
    if($conn->commit()){
        header('location:ConnexionFreelance.php');
        echo 'ok2';
    }

} catch (PDOException $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
    echo'non';
}
?>
