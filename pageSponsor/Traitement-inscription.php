<?php
session_start();

$nom = $prenom = $dateNaissance = $villeResidence = $numero = $email = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = htmlspecialchars(trim($_POST['Nom']));
    $prenom = htmlspecialchars(trim($_POST['Prenom']));
    $dateNaissance = htmlspecialchars(trim($_POST['DateNaissance']));
    $villeResidence = htmlspecialchars(trim($_POST['VilleResidence']));
    $numero = htmlspecialchars(trim($_POST['Numero']));
    $email = htmlspecialchars(trim($_POST['Email']));
    $username = htmlspecialchars(trim($_POST['Username']));
    $password = htmlspecialchars(trim($_POST['Password']));

    $errors = [];

    if (empty($nom)) {
        $errors[] = "Le nom est requis.";
    }
    if (empty($prenom)) {
        $errors[] = "Le prénom est requis.";
    }
    if (empty($email)) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    }
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis.";
    }
    if (empty($dateNaissance)) {
        $errors[] = "La date de naissance est requise.";
    }
    if (empty($villeResidence)) {
        $errors[] = "La ville de résidence est requise.";
    }
    if (empty($numero)) {
        $errors[] = "Le numéro de téléphone est requis.";
    }

    if (empty($errors)) {
        $servername = "localhost";
        $username_db = "root";
        $password_db = ""; 
        $dbname = "hackaton";

        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        if ($conn->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }

        $nom = $conn->real_escape_string($nom);
        $prenom = $conn->real_escape_string($prenom);
        $dateNaissance = $conn->real_escape_string($dateNaissance);
        $villeResidence = $conn->real_escape_string($villeResidence);
        $username = $conn->real_escape_string($username);
        $email = $conn->real_escape_string($email);
        $numero = $conn->real_escape_string($numero);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql_user = "INSERT INTO utilisateurs (nom, prenom, date_naissance, ville_residence, nom_utilisateur, mot_de_passe, email, numero_telephone, roles) 
                     VALUES ('$nom', '$prenom', '$dateNaissance', '$villeResidence', '$username', '$password_hash', '$email', '$numero', 'sponsor')";

        if ($conn->query($sql_user) === TRUE) {
            $sql_sponsor = "INSERT INTO sponsors (nom_utilisateur, numero, email) VALUES ('$username', '$numero', '$email')";

            if ($conn->query($sql_sponsor) === TRUE) {
                $_SESSION['message'] = "Inscription réussie !";
                header("Location: http://localhost/ProjetHackaton/pageSponsor/Connexion.php");
                exit();
            } else {
                echo "Erreur dans l'insertion des données du sponsor : " . $conn->error;
            }
        } else {
            echo "Erreur dans l'insertion des données de l'utilisateur : " . $conn->error;
        }

        $conn->close();
    } else {
        if (!empty($errors)) {
            $_SESSION['error_messages'] = $errors;
        }
    
        header("Location: http://localhost/ProjetHackaton/pageSponsor/Inscription.php");
        exit();
    }
}
?>