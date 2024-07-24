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
$recupEns = $db->prepare("SELECT * FROM enseignants");
$recupEns->execute();
$enseignants = $recupEns->fetchAll(PDO::FETCH_ASSOC);

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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h2 class="text-center mb-4 bg-light fw-bold">LISTE DES ENSEIGNANTS</h2>

                        <a href="dashboard.php" class="btn btn-primary fw-bold mb-3"><i class="fa-solid fa-arrow-left"></i> Dashboard</a>
                        <a href="add_teacher.php" class="btn btn-info fw-bold text-white mb-3">Ajouter un enseignant</a>
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
                                <?php foreach ($enseignants as $enseignant) : ?>
                                    <tr>
                                        <td><?php echo $enseignant['id']; ?></td>
                                        <td><?php echo $enseignant['nom'] . ' ' . $enseignant['prenom']; ?></td>
                                        <td><?php echo $enseignant['email']; ?></td>
                                        <td>Enseignant</td>
                                        <td>
                                            <!-- Lien pour supprimer un apprenant -->
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $enseignant['id']; ?>">
                                                Supprimer
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal<?= $enseignant['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez vous vraiment supprimer cet enseignant ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                            <a href="supprimerEmseignant.php?id=<?php echo $enseignant['id']; ?>" class="btn btn-danger btn-sm">Oui</a>
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
        </section>
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