<?php
include '_header.php'; //inclusion dela BD 

// Redirection si l'utilisateur est déjà connecté
if (isset($_SESSION['LOGGEDIN'])) {
    header("Location: index.php");
    exit(); // Arrêt de l'exécution du script
}

// Traitement du formulaire de connexion
if (isset($_POST['connexion'])) {
    $role = $_POST['role'];
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Vérification si les champs sont remplis
    if (!empty($email) && !empty($password)) {
        // Requête selon le rôle
        $reqA = $db->prepare("SELECT * FROM $role WHERE email = ?");
        $reqA->execute([$email]);
        $data = $reqA->fetch(PDO::FETCH_ASSOC);
        $count = $reqA->rowCount();

        // Si l'email est trouvé et le mot de passe correspond
        if ($count == 1 && password_verify($password, $data['password'])) {
            // Création des sessions
            $_SESSION['role'] = $role;
            $_SESSION['LOGGEDIN'] = true;
            $_SESSION['auth'] = $data;

            // Redirection vers la page d'accueil
            header("Location: index.php");
            exit();
        } else {
            $erreurMail = 'Email ou mot de passe incorrect !';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNEXION</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/inscription.css">
</head>

<body>
    <header class="border-bottom border-primary border-2 sticky-top bg-white">
        <?php
        if (isset($_SESSION['LOGGEDIN'])) {
            require_once(__DIR__ . '/headerC.php');
        } else {
            require_once(__DIR__ . '/header.php');
        }
        ?>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
                <h3 class="fw-bold">CONNEXION</h3>
                <p>Connectez-vous pour accéder aux différents cours</p>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="choix" class="mb-2 fw-bold"><span class="text-danger">* </span>Se connecter en tant que :</label>
                        <select name="role" class="form-select border border-primary border-2 rounded-pill text-primary" aria-label="Default select example">
                            <option value="apprenants" selected>Apprenant</option>
                            <option value="enseignants">Enseignant</option>
                            <option value="administrateurs">Administrateur</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Entrer votre email.." name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Entrer votre mot de passe.." name="password" id="password" required>
                    </div>
                    <?php
                    if (isset($erreurMail)) {
                        echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> ' . $erreurMail . '</p>';
                    }
                    ?>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary fw-bold" value="CONNEXION" name="connexion">
                    </div>
                    <div class="mb-3">
                        <p>Nouvel utilisateur? <a href="inscription.php" class="text-decoration-none fw-bold">S'INSCRIRE</a></p>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <footer class="bg-dark text-white">
        <?php require_once(__DIR__ . '/footer.php'); ?>
    </footer>


    <!--CDN BOOTSTRAP JAVASCRIPT-->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>