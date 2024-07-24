<?php
// Inclusion de la base de données
include '../_header.php';

// Vérification de l'accès
$user = $_SESSION['auth'];
$role = $_SESSION['role'];
if (!isset($_SESSION['LOGGEDIN']) && $role != 'administrateurs') {
    header("Location: ../index.php");
    exit;
}

// Récupération de la liste des apprenants depuis la base de données
$recupApp = $db->prepare("SELECT * FROM apprenants");
$recupApp->execute();
$apprenants = $recupApp->fetchAll(PDO::FETCH_ASSOC);
$countApp = $recupApp->rowCount();

// Récupération de la liste des enseignant depuis la base de données
$recupEns = $db->prepare("SELECT * FROM enseignants");
$recupEns->execute();
$enseignants = $recupApp->fetchAll(PDO::FETCH_ASSOC);
$countEns = $recupEns->rowCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/brands.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/solid.css">
    <link rel="stylesheet" href="../styles/style.css">
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

    <main>
        <div class="container my-3">
            <div class="row justify-content-center mt-4">
                <div class="col-3 bg-primary">
                    <div class="profilDef my-5 d-flex justify-content-center">
                        <img src="../images/profil.png" alt="profil par defaut" height="200px">
                    </div>
                    <ul class="list-unstyled">
                        <li><a href="gestion_formation.php" class="btn btn-primary fw-bold mb-3"><i class="fa-solid fa-hand-point-right"></i> Gestion des formations</a></li>
                        <li><a href="gestion_module.php" class="btn btn-primary fw-bold mb-3"><i class="fa-solid fa-hand-point-right"></i> Gestion des Modules</a></li>
                        <li><a href="gestion_enseignant.php" class="btn btn-primary fw-bold mb-3"><i class="fa-solid fa-hand-point-right"></i> Gestion des Enseignants</a></li>
                        <li><a href="gestionDesCategories.php" class="btn btn-primary fw-bold mb-3"><i class="fa-solid fa-hand-point-right"></i> Ajouter une Categorie</a></li>
                    </ul>
                </div>
                <div class="col-9">
                    <div class="row row-cols-2 mb-3">
                        <div class="col d-flex justify-content-center align-items-center py-2 bg-secondary fw-bold">
                            <?= $countApp ?> Apprenants
                        </div>
                        <div class="col d-flex justify-content-center align-items-center py-2 bg-info fw-bold">
                            <?= $countEns ?> Enseignants
                        </div>
                    </div>

                    <h2 class="text-center mb-4 bg-light fw-bold">LISTE DES APPRENANTS</h2>

                    <a href="addUser.php" class="btn btn-primary fw-bold mb-3">Ajouter un apprenant</a>
                    <!-- Tableau de la liste des apprenants -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom et Prenom</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($apprenants as $apprenant) : ?>
                                <tr>
                                    <td><?php echo $apprenant['id']; ?></td>
                                    <td><?php echo $apprenant['nom'] . ' ' . $apprenant['prenom']; ?></td>
                                    <td><?php echo $apprenant['email']; ?></td>
                                    <td>Apprenant</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $apprenant['id']; ?>">
                                            Supprimer
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal<?= $apprenant['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez vous vraiment supprimer cet apprenant ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                        <a href="supprimerApprenant.php?id=<?php echo $apprenant['id']; ?>" class="btn btn-danger btn-sm">Oui</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white">
        <!-- Inclusion du footer -->
        <?php require_once(__DIR__ . '/../footer.php'); ?>
    </footer>

    <!-- CDN BOOTSTRAP JAVASCRIPT -->
    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>