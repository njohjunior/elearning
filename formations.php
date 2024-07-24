<?php
include '_header.php'; // Inclusion de la base de données

$user = $_SESSION['auth'] ?? null;
$role = $_SESSION['role'] ?? null;

$formations = query($db, "SELECT * FROM formation ORDER BY nom ASC");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMATIONS</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header class="border-bottom border-primary border-2 sticky-top bg-white">
        <!--inclusion du header-->
        <?php
        if (isset($_SESSION['LOGGEDIN'])) {
            require_once(__DIR__ . '/headerC.php');
        } else {
            require_once(__DIR__ . '/header.php');
        }
        ?>
    </header>

    <main>
        <h2 class="text-center my-3 bg-light fw-bold">LISTE DES FORMATIONS</h2>
        <!-- Début de la liste des formations-->
        <div class="container my-4">
            <?php foreach ($formations as $formation) : ?>
                <div class="row">
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
                                        <p class="card-text d-flex justify-content-end"><a href="detail_formation.php?id=<?php echo $formation['id']; ?>" class="btn btn-primary">En savoir plus..</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

    <!--footer-->

    <footer class="bg-dark text-white">
        <!--inclusion du header-->
        <?php
        require_once(__DIR__ . '/footer.php');
        ?>
    </footer>

    <!--CDN BOOTSTRAP JAVASCRIPT-->
    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>