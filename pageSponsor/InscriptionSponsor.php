<?php
include('../include/connexionbd.php');
try {
    $sponsor = "sponsor";
    $stmt1=$conn->prepare("INSERT INTO Utilisateurs (nom, prenom, date_naissance, ville_residence, nom_utilisateur, mot_de_passe,email, numero_telephone, roles, date_inscription) VALUES (:nom, :prenom, :date_naissance, :ville_residence, :nom_utilisateur, :mot_de_passe,:email, :numero_telephone, :roles, now())");
    $stmt1->bindParam(":nom",$_POST['Nom']);
    $stmt1->bindParam(":prenom",$_POST['Prenom']);
    $stmt1->bindParam(":date_naissance",$_POST['DateNaissance']);
    $stmt1->bindParam(":ville_residence",$_POST['VilleResidence']);
    $stmt1->bindParam(":nom_utilisateur",$_POST['Username']);
    $stmt1->bindParam(":mot_de_passe",$_POST['Password']);
    $stmt1->bindParam(":email",$_POST['Email']);
    $stmt1->bindParam(":roles",$sponsor);
    $stmt1->bindParam(":numero_telephone",$_POST['Numero']);
    

    $stmt2=$conn->prepare("INSERT INTO Sponsors (nom_utilisateur, numero, email) VALUES (:nom_utilisateur, :numero_telephone, :email)");
    $stmt2->bindParam(":nom_utilisateur",$_POST['Username']);
    $stmt2->bindParam(":email",$_POST['Email']);
    $stmt2->bindParam(":numero_telephone",$_POST['Numero']);
    
    if($stmt1->execute() &&$stmt2->execute()){
        header('location:ConnexionSponsor.php');
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>