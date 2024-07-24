<?php
include '_header.php'; //inclusion dela BD 

$user = $_SESSION['auth'] ?? null;
$role = $_SESSION['role'] ?? null;
?>

<?php
if (isset($_POST['envoyer'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $numero = htmlspecialchars($_POST['numero']);
    $message = htmlspecialchars($_POST['message']);

    //tableau des erreurs
    $erreurC = array();
    if (empty($nom) and empty($prenom)) {
        $erreurNumero = ' Entrer votre nom et prenom';
        $erreurC['nom'] = $erreurNumero;
    }
    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurEmail = ' Entrer une adresse mail valide';
        $erreurC['mail'] = $erreurEmail;
    }
    if (empty($message)) {
        $erreurMessage = ' Entrer votre message svp';
        $erreurC['message'] = $erreurMessage;
    }

    if (empty($erreurC)) {
        //insertion des données du formulaire dans ma table apprenants
        $envoie = $db->prepare("INSERT INTO contact(nom,prenom,email,numero,message) VALUES (?,?,?,?,?)");
        $envoie->execute(array($nom, $prenom, $email, $numero, $message));

        //message de envoie effective
        $messageSucces = ' Message envoyé!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
        <!--Début du contenu principal-->
        <section class="contenu">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="d-flex justify-content-center my-3 text-dark fw-bolder border-bottom border-2">CONTACTEZ NOUS</h2>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-8 bg-light rounded py-3">
                        <h3 class="fw-bold">AVEZ-VOUS DES QUESTIONS ?</h3>
                        <h4>NOUS VOUS CONSEILLONS VOLONTIERS</h4>
                        <form method="POST">
                            <div class="py-2 mb-3">
                                <input name="nom" type="text" class="form-control mb-2" placeholder="Noms" aria-describedby="emailHelp">
                                <input name="prenom" type="text" class="form-control mb-2" placeholder="Prénoms" aria-describedby="emailHelp">
                                <input name="email" type="email" class="form-control mb-2" placeholder="Email" aria-describedby="emailHelp">
                                <input name="numero" type="number" class="form-control mb-2" placeholder="Numéro" aria-describedby="emailHelp">
                            </div>
                            <div class="form-floating mb-2">
                                <textarea name="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Mon Message</label>
                            </div>
                            <?php
                            if (isset($erreurNumero)) {
                                echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i>' . $erreurNumero . '</p>';
                            }
                            if (isset($erreurEmail)) {
                                echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i>' . $erreurEmail . '</p>';
                            }
                            if (isset($erreurMessage)) {
                                echo '<p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i>' . $erreurMessage . '</p>';
                            }
                            if (isset($messageSucces)) {
                                echo '<p class="text-success fw-bold fst-normal"><i class="fa-solid fa-square-check"></i>' . $messageSucces . '</p>';
                            }
                            ?>
                            <div class="my-2">
                                <button type="submit" class="btn btn-primary fw-bold" name="envoyer">ENVOYER MON MESSAGE</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-4 bg-primary rounded py-3 text-white">
                        <h3 class="fw-bold d-flex justify-content-center"><span class="border-bottom border-white border-2">NOS INFORMATIONS</span></h3>
                        <br>
                        <ul class="fs-6">
                            <li>
                                <i class="fa-solid fa-phone"></i> (+237) 679 218 617 (Douala) <br><br>
                                <i class="fa-solid fa-phone"></i> (+237) 690 722 267 (Douala) <br><br>
                                <i class="fa-solid fa-phone"></i> (+237) 691 702 783 (Ydé)
                            </li>
                            <br><br>
                            <li>
                                <i class="fa-solid fa-envelope"></i> Info@kamer-training.net
                            </li>
                            <br><br>
                            <li>
                                <i class="fa-solid fa-location-dot"></i> Yaoundé, Biyem-Assi Lac, CMR
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white">
        <!--inclusion du header-->
        <?php
        require_once(__DIR__ . '/footer.php');
        ?>
    </footer>

    <!--CDN BOOTSTRAP JAVASCRIPT-->
    <script type="text/javascript" src="vendor/bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>