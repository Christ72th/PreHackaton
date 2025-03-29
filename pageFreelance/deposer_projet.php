<?php
session_start();


if (!isset($_SESSION['Username'])) {
    header('Location: ../index.html');
    exit;
}
$uploadDirs = [
    'FichierProjet' => 'uploads/projets', 
    'ImageProjet' => 'uploads/images',
    'FichierReadme' => 'uploads/readmes',
];

// Fonction pour gérer les téléchargements de fichiers
function handleFileUpload($file, $uploadDir, $newFilename = '') {
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            throw new Exception("Impossible de créer le dossier d'upload : $uploadDir");
        }
    }

    // Vérifie si un fichier a été fourni
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return ''; 
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Erreur de téléchargement : " . $file['error']);
    }

    // Nettoie le nom du fichier
    $filename = $newFilename ?: basename($file['name']); 
    $filename = preg_replace("/[^a-zA-Z0-9._-]/", "", $filename); 
    $filepath = $uploadDir . '/' . $filename;

    // Vérifie si le fichier existe déjà
    if (file_exists($filepath)) {
        $baseFilename = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $counter = 1;
        while (file_exists($filepath)) {
            $filename = $baseFilename . '_' . $counter . '.' . $extension;
            $filepath = $uploadDir . '/' . $filename;
            $counter++;
        }
    }
    // Déplace le fichier téléchargé
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new Exception("Erreur lors du déplacement du fichier téléchargé.");
    }

    return $filepath; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $filePaths = [];
        foreach ($uploadDirs as $key => $dir) {
            $filePaths[$key] = handleFileUpload($_FILES[$key], $dir);
        }

        include('../include/connexionbd.php');
        include('../include/generer.php');

        $stmt = $conn->prepare("INSERT INTO projets (id_projet, titre, descriptions, date_debut, date_fin, url_executable, url_images, url_readme, statut, nom_utilisateur_f, budget_estime, competences_requises, technologies_utilisees, lien_depot, ressources_supplementaires, niveau_experience, type_collaboration) 
                                VALUES (:id_projet, :titre, :descriptions, NOW(), NOW(), :url_executable, :url_images, :url_readme, :statut, :nom_utilisateur_f, :budget_estime, :competences_requises, :technologies_utilisees, :lien_depot, :ressources_supplementaires, :niveau_experience, :type_collaboration)");

        $stmt->bindParam(":id_projet", $id); 
        $stmt->bindParam(":titre", $_POST['NomProjet']);
        $stmt->bindParam(":descriptions", $_POST['Description']);
        $stmt->bindParam(":url_executable", $filePaths['FichierProjet']);
        $stmt->bindParam(":url_images", $filePaths['ImageProjet']);
        $stmt->bindParam(":url_readme", $filePaths['FichierReadme']);
        $stmt->bindParam(":statut", $_POST['Statut']);
        $stmt->bindParam(":nom_utilisateur_f", $_SESSION['Username']);
        $stmt->bindParam(":budget_estime", $_POST['Budget']);
        $stmt->bindParam(":competences_requises", $_POST['Competences']);
        $stmt->bindParam(":technologies_utilisees", $_POST['Technologies']);
        $stmt->bindParam(":lien_depot", $_POST['LienDepot']);
        $stmt->bindParam(":ressources_supplementaires", $_POST['Ressources']);
        $stmt->bindParam(":niveau_experience", $_POST['Experience']);
        $stmt->bindParam(":type_collaboration", $_POST['Collaboration']);

        if ($stmt->execute()) {
            header('Location: Accueil.php');
            exit();
        } else {
            throw new Exception("Erreur lors de l'insertion des données dans la base de données.");
        }
    } catch (Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}
?>
