<?php
include '_header.php'; // Inclusion de la base de données 

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['LOGGEDIN'])) {
    header("Location: connexion.php");
    exit(); // Assure que le script s'arrête ici après la redirection
}

$user = $_SESSION['auth'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL</title>
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
        <section class="profil">
            <div class="container">
                <div class="row">
                    <div class="col-5 bg-primary text-white d-flex flex-column justify-content-center align-items-center">
                        <div class="profilDef my-5">
                            <img src="images/profil.png" alt="profil par defaut" height="200px">
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h3 class="fw-bold text-uppercase">BIENVENUE <?= $user['nom'] ?></h3>
                            <p class="fst-italic">Vous pouvez modifier votre profil à tout moment</p>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col d-flex flex-column justify-content-center align-items-start">
                        <h3 class="my-3"><span class="fw-bold border-bottom border-dark border-2">VOS INFORMATIONS</span></h3>

                        <table class="table table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col"><span class="fw-bold">Rôle :</span></th>
                                    <th scope="col"><?= $_SESSION['role'] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><span class="fw-bold">Nom :</span></th>
                                    <td><?= $user['nom'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><span class="fw-bold">Prénom :</span></th>
                                    <td><?= $user['prenom'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><span class="fw-bold">Email :</th>
                                    <td><?= $user['email'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <a href="modification.php" class="text-decoration-none fw-bold"><i class="fa-solid fa-gear"></i>  MODIFIER MES INFORMATIONS</a>
                        </div>
                        <div class="mb-3">
                            <a href="modificationpassword.php" class="text-decoration-none fw-bold"><i class="fa-solid fa-key"></i>  MODIFIER MON MOT DE PASSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white">
        <!-- Inclusion du footer -->
        <?php require_once(__DIR__ . '/footer.php'); ?>
    </footer>

    <!-- CDN BOOTSTRAP JAVASCRIPT -->
    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>