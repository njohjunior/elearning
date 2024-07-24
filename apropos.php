<?php
include '_header.php'; //inclusion dela BD 

$user = $_SESSION['auth'] ?? null;
$role = $_SESSION['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos</title>
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
        <section class="a-propos">
            <div class="container pb-3">
                <div class="row">
                    <div class="col py-3 text-uppercase text-center bg-info" style="--bs-bg-opacity: .5;">
                        <h2 class="fw-bold">À propos de nous</h2>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">
                        <h3>Notre Mission</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae voluptas nesciunt provident eum nemo ad ipsa ex laboriosam, expedita vel possimus quasi fugiat suscipit illum quibusdam dolore. Incidunt, ratione corporis.</p>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">
                        <h3>Notre Histoire</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae voluptas nesciunt provident eum nemo ad ipsa ex laboriosam, expedita vel possimus quasi fugiat suscipit illum quibusdam dolore. Incidunt, ratione corporis.</p>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">
                        <h3>Notre Équipe</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae voluptas nesciunt provident eum nemo ad ipsa ex laboriosam, expedita vel possimus quasi fugiat suscipit illum quibusdam dolore. Incidunt, ratione corporis.</p>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col">
                        <h3>Contactez-nous</h3>
                        <p>Si vous avez des questions, des commentaires ou des suggestions, n'hésitez pas à nous contacter. Nous sommes toujours heureux d'entendre nos utilisateurs et de trouver des moyens d'améliorer notre plateforme.</p>
                        <p><a href="contact.php" class="btn btn-primary">Envoyer un message</a></p>
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