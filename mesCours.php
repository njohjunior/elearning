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

// Récupération des formations auxquelles l'apprenant est inscrit
$mescours = $db->prepare("SELECT formation.* FROM formation
    JOIN inscription ON formation.id = inscription.id_formation
    WHERE inscription.id_apprenant = ?");
$mescours->execute([$userId]);
$formations = $mescours->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Formations</title>
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
        <section class="my-formations">
            <div class="container pb-3">
                <div class="row">
                    <div class="col py-3 text-uppercase text-center bg-success" style="--bs-bg-opacity: .5;">
                        <h2 class="fw-bold">Mes Formations</h2>
                    </div>
                </div>

                <?php if (count($formations) > 0) : ?>
                    <div class="row">
                        <?php foreach ($formations as $formation) : ?>
                            <div class="row py-2">
                                <div class="col">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="images/<?= $formation['image'] ?>" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold text-uppercase"><?= $formation['nom'] ?></h5>
                                                    <p class="card-text"><?= $formation['description'] ?></p>
                                                    <p class="card-text d-flex justify-content-end"><a href="contenu_formation.php?id=<?php echo $formation['id']; ?>" class="btn btn-primary">Consulter</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col py-3 text-center">
                            <p>Vous n'êtes inscrit à aucune formation pour le moment.</p>
                        </div>
                    </div>
                <?php endif; ?>
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