<?php
include '_header.php'; // Inclusion de la BD

// Si une session n'existe pas, redirection vers la page d'index
if (!isset($_SESSION['LOGGEDIN'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['auth'];
$role = $_SESSION['role'];

if (isset($_POST['modifier'])) {
    $password = htmlspecialchars($_POST['password']);
    $cpassword = htmlspecialchars($_POST['cpassword']);

    // Tableau d'erreurs
    $erreurs = array();

    // Validation des mots de passe
    if (strlen($password) <= 7) {
        $erreurs['taille'] = 'Votre mot de passe est trop court.';
    }

    if ($password != $cpassword) {
        $erreurs['diffMDP'] = 'Les mots de passe doivent être identiques.';
    }

    // Si le tableau des erreurs est vide, procéder à la modification
    if (empty($erreurs)) {
        // Hashing du mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Mise à jour du mot de passe dans la table
        $updateMDP = $db->prepare("UPDATE {$role} SET password = ?, cpassword = ? WHERE id = ?");
        $updateMDP->execute(array($passwordHash, $passwordHash, $user['id']));

        // Mise à jour des données de session avec les nouvelles valeurs
        $_SESSION['auth']['password'] = $passwordHash;
        $_SESSION['auth']['cpassword'] = $passwordHash;

        // Redirection après modification
        header("Location: profil.php");
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du Mot de Passe</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/inscription.css">
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

    <!-- Début du formulaire de modification du mot de passe -->

    <div class="container my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
                <h3 class="fw-bold">Modification du Mot de Passe</h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <p class="text-center"><?= htmlspecialchars($user['nom']) . ', vous allez modifier votre mot de passe' ?></p>
                    </div>
                    <div class="mb-3">
                        <input type="password" placeholder="Entrez votre nouveau mot de passe..." name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="password" placeholder="Confirmez votre nouveau mot de passe..." name="cpassword" id="cpassword" class="form-control">
                    </div>
                    <?php
                    if (!empty($erreurs)) {
                        foreach ($erreurs as $erreur) {
                            echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> ' . $erreur . '</p>';
                        }
                    }
                    ?>
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
        <!--inclusion du footer-->
        <?php
        require_once(__DIR__ . '/footer.php');
        ?>
    </footer>

    <!--CDN BOOTSTRAP JAVASCRIPT-->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>