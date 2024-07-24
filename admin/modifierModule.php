<?php
include '../_header.php'; // Inclusion de la base de données

$user = $_SESSION['auth'] ?? null;
$role = $_SESSION['role'] ?? null;

// Vérification de la session et du rôle de l'utilisateur
if (!isset($_SESSION['LOGGEDIN']) || !in_array($role, ['administrateurs', 'enseignants'])) {
    header("Location: ../index.php");
    exit();
}

// Récupération de l'ID du module depuis l'URL
$module_id = $_GET['id'] ?? null;

if (!$module_id) {
    header("Location: ../index.php");
    exit();
}

// Récupération des informations du module actuel
$moduleStmt = $db->prepare("SELECT * FROM module WHERE id = ?");
$moduleStmt->execute([$module_id]);
$module = $moduleStmt->fetch();

if (!$module) {
    header("Location: ../index.php");
    exit();
}

// Traitement du formulaire de modification de module
if (isset($_POST['modifier'])) {
    // Récupération des informations du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $contenu = $_POST['contenu'];

    // Préparation de la requête SQL de mise à jour
    $sql = "UPDATE module SET nom = ?, description = ?, contenu = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$nom, $description, $contenu, $module_id]);

    if ($result) {
        $success = "Module modifié avec succès!";
        // mise a jour des informations du module après la modification
        $module = ['nom' => $nom, 'description' => $description, 'contenu' => $contenu];
    } else {
        $echec = "Erreur lors de la modification du module";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Module</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="../vendor/summernote/summernote.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/inscription.css">

    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>

    <link rel="stylesheet" href="../vendor/summernote/summernote.min.css">
    <script type="text/javascript" src="../vendor/summernote/summernote.min.js"></script>
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

<!-- Début du formulaire de modification de module -->
<div class="container my-4">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
            <h3 class="fw-bold">MODIFIER UN MODULE</h3>
            <p>Cette page vous permet de modifier un module existant</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" class="form-control" placeholder="Nom du module..." name="nom" id="nom" value="<?= $module['nom'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= $module['description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu :</label>
                    <textarea class="form-control" id="contenu" name="contenu" rows="3"><?= $module['contenu'] ?></textarea>
                </div>

                <?php if (isset($echec)) : ?>
                    <p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> <?= $echec ?></p>
                <?php elseif (isset($success)) : ?>
                    <p class="text-success fw-bold"><i class="fa-solid fa-square-check"></i> <?= $success ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <input type="submit" class="bouton fw-bold" value="Modifier" name="modifier">
                </div>
            </form>
        </div>
        <div class="col-1"></div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="../vendor/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contenu').summernote({
            tabsize: 2,
            height: 300
        });
    });
</script>
</body>

</html>
