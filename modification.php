<?php
include '_header.php'; // Inclusion de la base de données 

// Si une session n'existe pas, redirection vers la page d'index
if (!isset($_SESSION['LOGGEDIN'])) {
    header("Location: index.php");
    exit(); // Assure que le script s'arrête ici après la redirection
}

$user = $_SESSION['auth'];
$role = $_SESSION['role'];

// Action lorsque le formulaire de modification est soumis
if (isset($_POST['modifier'])) {
    // Récupération des informations du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);

    // Tableau d'erreurs
    $erreurs = array();

    // Validation de l'email
    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurEmail = 'Entrer une adresse mail valide';
        $erreurs['mail'] = $erreurEmail;
    }

    // Validation du nom et du prénom
    if (empty($nom) || empty($prenom)) {
        $erreurNom = 'Entrer votre nom et prénom';
        $erreurs['nom'] = $erreurNom;
    }

    // Si le tableau des erreurs est vide, procéder à la modification
    if (empty($erreurs)) {
        // Mise à jour des données dans la table selon le rôle
        $update = $db->prepare("UPDATE {$role} SET nom = ?, prenom = ?, email = ? WHERE id = ?");
        $update->execute(array($nom, $prenom, $email, $user['id']));

        // Récupération des données mises à jour de l'utilisateur
        $updatedUser = $db->prepare("SELECT * FROM {$role} WHERE id = ?");
        $updatedUser->execute(array($user['id']));
        $updatedUserData = $updatedUser->fetch(PDO::FETCH_ASSOC);

        // Mise à jour des données de session avec les nouvelles valeurs
        $_SESSION['auth'] = $updatedUserData;

        // Redirection après la modification
        header("Location: profil.php");
        exit(); // Assure que le script s'arrête ici après la redirection
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFICATION</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/inscription.css">
    <style>
        .erreur {
            color: red;
        }
    </style>
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

    <!-- Début du formulaire de modification -->

    <div class="container my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
                <h3 class="fw-bold">MODIFICATION</h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?= $user['nom'] ?>">
                        <?php
                        if (isset($erreurNom)) {
                            echo '<p class="erreur">' . $erreurNom . '</p>';
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?= $user['prenom'] ?>">
                        <?php
                        if (isset($erreurNom)) {
                            echo '<p class="erreur">' . $erreurNom . '</p>';
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= $user['email'] ?>">
                        <?php
                        if (isset($erreurEmail)) {
                            echo '<p class="erreur">' . $erreurEmail . '</p>';
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary fw-bold" value="MODIFIER" name="modifier">
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

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