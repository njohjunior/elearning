<?php
include '_header.php'; // Inclusion de la base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['auth'])) {
    header("Location: connexion.php");
    exit();
}

$role = $_SESSION['role'];

$user = $_SESSION['auth'];
$userId = $user['id'];
$module_id = $_GET['id'];

// Récupération des informations du module
$moduleA = $db->prepare("SELECT * FROM module WHERE id = ?");
$moduleA->execute([$module_id]);
$module = $moduleA->fetch();

// Récupération de la formation associée pour navigation et contexte
$formationA = $db->prepare("SELECT formation.* FROM formation
    JOIN formation_module ON formation.id = formation_module.id_formation
    WHERE formation_module.id_module = ?");
$formationA->execute([$module_id]);
$formation = $formationA->fetch();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenu de la formation</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <header class="border-bottom border-primary border-2 sticky-top bg-white">
        <!-- Inclusion du header -->
        <?php
        if (isset($_SESSION['LOGGEDIN'])) {
            require_once(__DIR__ . '/headerC.php');
        } else {
            require_once(__DIR__ . '/header.php');
        }
        ?>
    </header>

    <main>
        <section class="contenu-module">
            <div class="container pb-3">
                <div class="row">
                    <div class="col py-3 text-uppercase text-center bg-info" style="--bs-bg-opacity: .5;">
                        <h2 class="fw-bold">Module : <?= $module['nom'] ?></h2>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">
                        <p><?= $module['description'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <h4>Contenu du Module :</h4>
                        <p><?= $module['contenu'] ?></p>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">
                        <a href="contenu_formation.php?id=<?= $formation['id'] ?>" class="btn btn-primary">Retour aux contenus</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--footer-->
    <footer class="bg-dark text-white">
        <!-- Inclusion du footer -->
        <?php require_once(__DIR__ . '/footer.php'); ?>
    </footer>

    <!--CDN BOOTSTRAP JAVASCRIPT-->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>