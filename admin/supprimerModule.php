<?php
include '../_header.php'; // Inclusion de la base de données

// Vérification de la présence de l'identifiant du module dans l'URL
if (isset($_GET['id'])) {
    $module_id = $_GET['id'];

    // Suppression des enregistrements dans la table enseignants_modules correspondant au module
    $delete_enseignants_modules = $db->prepare("DELETE FROM enseignants_modules WHERE module_id = ?");
    $delete_enseignants_modules->execute([$module_id]);

    // Suppression du module
    $delete_module = $db->prepare("DELETE FROM module WHERE id = ?");
    $delete_module->execute([$module_id]);

    // Redirection vers la page de gestion des modules
    header("Location: gestion_module.php");
    exit;
} else {
    // Redirection si l'ID du module n'est pas fourni dans l'URL
    header("Location: gestion_module.php");
    exit;
}
?>
