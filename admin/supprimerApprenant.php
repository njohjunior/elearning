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

    // Suppression de l'apprenant correspondant à l'identifiant
    $suppressionApprenant = $db->prepare("DELETE FROM apprenants WHERE id = ?");
    $suppressionApprenant->execute([$id]);

    //redirection
    header("location: dashboard.php");
    exit;
}
?>
