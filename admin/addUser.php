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

    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($email, PASSWORD_DEFAULT); // Le mot de passe est généré à partir de l'email

    // Vérification si l'email est vide
    if (!empty($email)) {
        // Vérification si l'email existe déjà dans la base de données
        $reqVerif = $db->prepare("SELECT * FROM apprenants WHERE email = ?");
        $reqVerif->execute([$email]);
        $count = $reqVerif->rowCount();

        if ($count > 0) {
            $erreurDeConnexion = 'Cet email est déjà utilisé par un autre compte.';
        } else {
            // Insertion des données dans la base de données
            $reqA = $db->prepare("INSERT INTO apprenants (email, password) VALUES (?, ?)");
            $reqA->execute([$email, $password]);
            $messageSuc = 'Apprenant créé avec succès';
        }
    } else {
        $erreurDeConnexion = 'Veuillez remplir tous les champs';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Apprenant</title>
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
                <h3 class="fw-bold">AJOUT APPRENANTS</h3>
                <p>Cette page vous permet d'ajouter de nouveaux apprenants</p>
                <form action="" method="POST">

                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Entrer votre email.." name="email" id="email">
                    </div>

                    <?php if (isset($erreurDeConnexion)) : ?>
                        <p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> <?= $erreurDeConnexion ?></p>
                    <?php elseif (isset($messageSuc)) : ?>
                        <p class="text-success fw-bold"><i class="fa-solid fa-square-check"></i> <?= $messageSuc ?></p>
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
</body>

</html>