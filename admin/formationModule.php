<?php
include '../_header.php'; // Inclusion de la base de données
$user = $_SESSION['auth'];
$role = $_SESSION['role'];
// Vérification de la session et du rôle de l'utilisateur
if (!isset($_SESSION['LOGGEDIN']) || $_SESSION['role'] != 'administrateurs') {
    header("Location: ../index.php");
    exit();
}

// Récupération des modules et formations
$modules = query($db, "SELECT * FROM module");
$formations = query($db, "SELECT * FROM formation");

if (isset($_POST['ajouter'])) {
    // Récupération des informations du formulaire
    $id_formation = htmlspecialchars($_POST['id_formation']);
    $id_modules = $_POST['id_module'];

    // Vérification des champs
    if (!empty($id_formation) && !empty($id_modules)) {
        foreach ($id_modules as $id_module) {
            $exist = query($db, "SELECT * FROM formation_module WHERE id_formation=:id_formation AND id_module=:id_module", compact("id_formation", "id_module"), true);
            if (!$exist) {
                $data = compact("id_formation", "id_module");
                $sql = "INSERT INTO formation_module SET id_formation=:id_formation, id_module=:id_module";
                $insertionModule = insert($db, $sql, $data);
                if ($insertionModule) {
                    $success = "Module ajouté avec succès!";
                } else {
                    $echec = "Erreur lors de l'ajout du module.";
                }
            }
        }
    } else {
        $echec = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Module</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="../vendor/summernote/summernote.min.css">
    <link rel="stylesheet" href="../styles/style.css">
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
            <div class="col-1"></div>
            <div class="col-10 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
                <h3 class="fw-bold">AJOUTER UN MODULE A UNE FORMATION</h3>
                <p>Cette page vous permet d'ajouter des nouveaux modules</p>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="formation" class="mb-2 fw-bold"><span class="text-danger">* </span>Formation :</label>
                        <select name="id_formation" class="form-select border border-primary border-2 text-primary" aria-label="Default select example">
                            <option value="">Choisir une formation</option>
                            <?php foreach ($formations as $formation) : ?>
                                <option value="<?= $formation['id'] ?>"><?= $formation['nom'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="module" class="mb-2 fw-bold"><span class="text-danger">* </span>Module :</label>
                        <select name="id_module[]" class="form-select border border-primary border-2 text-primary" aria-label="Default select example" multiple>
                            <option value="">Choisir un module</option>
                            <?php foreach ($modules as $module) : ?>
                                <option value="<?= $module['id'] ?>"><?= $module['nom'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <p class="text-sm">* Cliquez et maintenez sur "CTRL" pour choisir plusieur</p>
                    </div>

                    <?php if (isset($echec)) : ?>
                        <p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> <?= $echec ?></p>
                    <?php elseif (isset($success)) : ?>
                        <p class="text-success fw-bold"><i class="fa-solid fa-square-check"></i> <?= $success ?></p>
                    <?php endif; ?>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary fw-bold" value="AJOUTER" name="ajouter">
                    </div>
                </form>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <!-- Inclusion du footer -->
        <?php require_once(__DIR__ . '/../footer.php'); ?>
    </footer>

    <!-- CDN BOOTSTRAP JAVASCRIPT -->
    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>