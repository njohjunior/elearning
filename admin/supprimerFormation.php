<?php
include '../_header.php'; // Inclusion de la base de données

// Vérification de l'accès

$user = $_SESSION['auth'];
$role = $_SESSION['role'];

if (!isset($_SESSION['LOGGEDIN']) && $role != 'administrateurs') {
    header("Location: ../index.php");
    exit;
}

// Vérification de la présence de l'identifiant de l'apprenant dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Suppression des enregistrements dans la table formation_module correspondant au module
    $delete_formation_module = $db->prepare("DELETE FROM formation_module WHERE id_formation = ?");
    $delete_formation_module->execute([$id]);

    // Suppression de l'apprenant correspondant à l'identifiant
    $suppressionFormation = $db->prepare("DELETE FROM formation WHERE id = ?");
    $suppressionFormation->execute([$id]);

    //redirection
    header("location: gestion_formation.php");
    exit;
}
?>
