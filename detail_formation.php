<?php
include '_header.php'; // Inclusion de la base de données

$user = $_SESSION['auth'] ?? null;
$role = $_SESSION['role'] ?? null;

if(isset($role) && $role != 'apprenants'){
    $erreurRole = 'Vous devez vous connecter a un compte apprenant pour vous inscrire';
}
// Récupération de l'ID de la formation depuis l'URL
$formation_id = $_GET['id'];

// Récupération des informations de la formation
$formationSt = $db->prepare("SELECT * FROM formation WHERE id = ?");
$formationSt->execute([$formation_id]);
$formation = $formationSt->fetch();

if (!$formation) {
    header("Location: formations.php");
    exit();
}

// Récupération des modules associés à cette formation via la table de liaison
$moduleStmt = $db->prepare("SELECT module.* FROM module
    JOIN formation_module ON module.id = formation_module.id_module
    WHERE formation_module.id_formation = ?");
$moduleStmt->execute([$formation_id]);
$modules = $moduleStmt->fetchAll();

// Vérification si l'utilisateur est inscrit à cette formation

$inscrire = false;
if ($user) {
    $inscriptionStmt = $db->prepare("SELECT * FROM inscription WHERE id_apprenant = ? AND id_formation = ?");
    $inscriptionStmt->execute([$user['id'], $formation_id]);
    $inscrire = $inscriptionStmt->rowCount() > 0;
}

// Traitement de l'inscription à la formation
if (isset($_POST['inscrire'])) {
    if ($user && !$inscrire) {
        $inscriptionA = $db->prepare("INSERT INTO inscription (id_apprenant, id_formation) VALUES (?, ?)");
        $inscriptionA->execute([$user['id'], $formation_id]);
        header("Location: detail_formation.php?id=" . $formation_id);
        exit();
    } elseif (!$user) {
        header("Location: connexion.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la formation</title>
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
    <section class="detail">
        <div class="container pb-3">
            <div class="row">
                <div class="col py-3 text-uppercase text-center bg-success" style="--bs-bg-opacity: .5;">
                    <h2 class="fw-bold">Formation : <?= $formation['nom'] ?> </h2>
                </div>
            </div>

            <div class="row pt-3">
                <div class="col">
                    <p><?= $formation['description'] ?></p>
                </div>
            </div>

            <div class="row">
                <h4 class="fw-bold text-center"><span class="border-bottom border-2 border-dark">Modules de la Formation</span> :</h4>
                <div class="col py-3">
                    <table class="table table-info table-bordered border-primary">
                        <thead>
                            <tr class="table-primary">
                                <th class="text-center">Modules</th>
                                <th class="text-center">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modules as $module) : ?>
                                <tr>
                                    <td><?= $module['nom'] ?></td>
                                    <td><?= $module['description'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Prix :</strong> <?= $formation['prix'] ?> FCFA</p>
                    <p><strong>Durée :</strong> <?= $formation['duree'] ?> Mois</p>
                    
                    <?php
                    if(isset($erreurRole)){
                        echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> ' . $erreurRole . '</p>';
                    }
                    ?>
                    <?php if ($user && !$inscrire): ?>
                        <form method="POST">
                            <button type="submit" name="inscrire" class="btn btn-primary fw-bold">S'inscrire à la formation</button>
                        </form>
                    <?php elseif ($inscrire): ?>
                        <p class="text-success fw-bold">Vous êtes déjà inscrit à cette formation.</p>
                        <p><a href="contenu_formation.php?id=<?= $formation['id'] ?>" class="btn btn-primary">Consulter la formation</a></p>
                    <?php else: ?>
                        <p><a href="connexion.php" class="btn btn-primary fw-bold">S'inscrire à la formation</a></p>
                    <?php endif; ?>
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