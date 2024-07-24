<?php
include '../_header.php'; // Inclusion de la base de données

$user = $_SESSION['auth'] ?? null;
$role = $_SESSION['role'] ?? null;

// Vérification de la session et du rôle de l'utilisateur
if (!isset($_SESSION['LOGGEDIN']) || $_SESSION['role'] != 'administrateurs') {
    header("Location: ../index.php");
    exit();
}

// Récupération de l'ID de la formation depuis l'URL
$formation_id = $_GET['id'];

// Récupération des informations de la formation
$formationStmt = $db->prepare("SELECT * FROM formation WHERE id = ?");
$formationStmt->execute([$formation_id]);
$formation = $formationStmt->fetch();

if (!$formation) {
    header("Location: formations.php");
    exit();
}

$categories = query($db, "SELECT * FROM categorie");

// Traitement du formulaire de modification de formation
if (isset($_POST['modifier'])) {
    // Récupération des informations du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $duree = htmlspecialchars($_POST['duree']);
    $prix = htmlspecialchars($_POST['prix']);
    $description = htmlspecialchars($_POST['description']);
    $id_categorie = htmlspecialchars($_POST['id_categorie']);

    // Mise à jour de la formation
    $sql = "UPDATE formation SET nom = ?, duree = ?, prix = ?, description = ?, id_categorie = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$nom, $duree, $prix, $description, $id_categorie, $formation_id]);

    if ($result) {
        $success = "Formation modifiée avec succès!";
    } else {
        $echec = "Erreur lors de la modification de la formation";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Formation</title>
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

<!-- Début du formulaire de modification de la formation -->
<div class="container my-4">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-white py-3 forme">
            <h3 class="fw-bold">MODIFIER UNE FORMATION</h3>
            <p>Cette page vous permet de modifier une formation existante</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="categorie" class="mb-2 fw-bold"><span class="text-danger">* </span>Categorie :</label>
                    <select name="id_categorie" class="form-select border border-primary border-2 text-primary" aria-label="Default select example">
                        <option value="">Choisir une categorie</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie['id'] ?>" <?= $categorie['id'] == $formation['id_categorie'] ? 'selected' : '' ?>><?= $categorie['nom'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nom de la formation.." name="nom" id="nom" value="<?= $formation['nom'] ?>" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Prix en CFA.." name="prix" id="prix" value="<?= $formation['prix'] ?>" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Nombre de mois.." name="duree" id="duree" value="<?= $formation['duree'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= $formation['description'] ?></textarea>
                </div>

                <?php if (isset($echec)) : ?>
                    <p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> <?= $echec ?></p>
                <?php elseif (isset($success)) : ?>
                    <p class="text-success fw-bold"><i class="fa-solid fa-square-check"></i> <?= $success ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <input type="submit" class="bouton fw-bold" value="Modifier" name="modifier">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
