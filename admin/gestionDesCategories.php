<?php
include '../_header.php'; // Inclusion de la base de données

$user = $_SESSION['auth'];
$role = $_SESSION['role'];

// Vérification de la session et du rôle de l'utilisateur
if (!isset($_SESSION['LOGGEDIN']) || $_SESSION['role'] != 'administrateurs') {
    header("Location: ../index.php");
    exit();
}

// Traitement du formulaire d'ajout de membre
if (isset($_POST['ajouter'])) {
    // Récupération des informations du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $image = "default.jpg";

    $data = compact("nom", "description", "image");
    $sql = "INSERT INTO categorie SET nom=:nom, description=:description, image=:image";
    if ($insertionImage = insert($db, $sql, $data)) {
        $success = "Catégorie créé avec succes!";
    } else {
        $echec = "Erreur lors de la création dela categorie";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Categories</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/inscription.css">
</head>

<body>

    <header class="border-bottom border-primary border-2 sticky-top bg-white">
        <!-- Inclusion du header -->
        <?php
        if (isset($_SESSION['LOGGEDIN'])) {
            require_once(__DIR__ . '/../headerC.php');
        } else {
            require_once(__DIR__ . '/../header.php');
        }
        ?>
    </header>

    <!-- Début du formulaire d'ajout de membre -->
    <div class="container my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
                <h3 class="fw-bold">AJOUTER UNE NOUVELLE CATEGORIE</h3>
                <p>Cette page vous permet d'ajouter des nouvelles categories</p>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="fw-bold">Nom de la categorie :</label>
                        <input type="text" class="form-control" name="nom" id="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="fw-bold">Description :</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <?php if (isset($echec)) : ?>
                        <p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> <?= $echec ?></p>
                    <?php elseif (isset($success)) : ?>
                        <p class="text-success fw-bold"><i class="fa-solid fa-square-check"></i> <?= $success ?></p>
                    <?php endif; ?>

                    <div class="mb-3">
                        <input type="submit" class="bouton fw-bold" value="AJOUTER" name="ajouter">
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <!--footer-->

    <footer class="bg-dark text-white">
        <!-- Inclusion du footer -->
        <?php require_once(__DIR__ . '/../footer.php'); ?>
    </footer>

    <!--CDN BOOTSTRAP JAVASCRIPT-->
    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    </