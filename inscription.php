<?php
include '_header.php'; // Inclusion de la base de données

// Si une session existe, rediriger vers l'index
if (isset($_SESSION['LOGGEDIN'])) {
    header("Location: index.php");
    exit();
}

// Action si on clique sur inscription
if (isset($_POST['inscription'])) {
    // Récupération des informations du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $cpassword = htmlspecialchars($_POST['cpassword']);

    // Tableau pour les messages d'erreurs
    $erreurs = array();

    // Vérifications des erreurs
    if (strlen($password) <= 7) {
        $erreurs['taille'] = 'Votre mot de passe est trop court';
    }

    if ($password !== $cpassword) {
        $erreurs['diffMDP'] = 'Les mots de passe doivent être identiques';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['mail'] = 'Entrer une adresse mail valide';
    }

    if (empty($nom) || empty($prenom)) {
        $erreurs['nom'] = 'Entrer votre nom et prénom';
    }

    // Vérification si l'email existe déjà dans la base de données
    $req = $db->prepare("SELECT * FROM apprenants WHERE email = ?");
    $req->execute([$email]);
    $countEmail = $req->rowCount();

    if ($countEmail > 0) {
        $erreurs['user'] = 'Cet email est déjà utilisé par un autre compte.';
    } else {
        // Si le tableau des erreurs est vide, insertion des données
        if (empty($erreurs)) {
            // Hashing du mot de passe
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $cpasswordHash = password_hash($cpassword, PASSWORD_DEFAULT);

            $insertion = $db->prepare("INSERT INTO apprenants (nom, prenom, email, password,cpassword) VALUES (?, ?, ?, ?, ?)");
            if ($insertion->execute([$nom, $prenom, $email, $passwordHash, $cpasswordHash])) {
                $messageSucces = 'Compte créé, veuillez vous connecter !';
            } else {
                $erreurs['db'] = 'Erreur lors de la création du compte. Veuillez réessayer plus tard.';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
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

    <!-- Début du formulaire d'inscription -->

    <div class="container my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
                <h3 class="fw-bold">INSCRIPTION</h3>
                <p>Inscrivez-vous pour accéder aux différents cours</p>
                <form action="" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Entrer votre nom.." name="nom" id="nom" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Entrer votre prénom.." name="prenom" id="prenom" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Entrer votre email.." name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Entrer votre mot de passe.." name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Confirmer votre mot de passe.." name="cpassword" id="cpassword" required>
                    </div>
                    <?php
                    if (!empty($erreurs)) {
                        foreach ($erreurs as $erreur) {
                            echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> ' . $erreur . '</p>';
                        }
                    }
                    if (isset($messageSucces)) {
                        echo '<p class="text-success fw-bold"><i class="fa-solid fa-square-check"></i> ' . $messageSucces . '</p>';
                    }
                    ?>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary fw-bold" value="INSCRIPTION" name="inscription">
                    </div>
                    <div class="mb-3">
                        <p>Déjà un compte ? <a href="connexion.php" class="text-decoration-none fw-bold">SE CONNECTER</a></p>
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