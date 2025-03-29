<?php
session_start(); // Démarrer la session
session_unset(); // Libérer les variables de session
session_destroy(); // Détruire la session
header('Location: index.html'); //
?>