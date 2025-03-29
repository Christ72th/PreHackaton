<?php
session_start();

$username = $password = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = htmlspecialchars(trim($_POST['Username']));
    $password = htmlspecialchars(trim($_POST['Password']));
    
    if (empty($username) || empty($password)) {
        $error_message = "Le nom d'utilisateur et le mot de passe sont requis.";
        $_SESSION['error_message'] = $error_message;
        header("Location: http://localhost/ProjetHackaton/pageSponsor/Connexion.php"); 
        exit();
    }

    $servername = "localhost";
    $db_username = "root"; 
    $db_password = ""; 
    $dbname = "hackaton"; 
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($username);

    $sql = "SELECT mot_de_passe FROM utilisateurs WHERE nom_utilisateur = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['mot_de_passe'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['Username'] = $username;
            header("Location:Dashboard-Sponsor.php"); 
            exit(); 
        } else {
            $error_message = "Mot de passe incorrect.";
        }
    } else {
        $error_message = "Le nom d'utilisateur n'existe pas.";
    }

    $conn->close();

    if (!empty($error_message)) {
        $_SESSION['error_message'] = $error_message;
        header("Location:Connexion.php"); 
        exit();
    }
}
?>