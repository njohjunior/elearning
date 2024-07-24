<?php
//include 'db.php'; //inclusion dela BD 
include '_header.php';

if (isset($_SESSION['auth'])) {
    $user = $_SESSION['auth'];
    $role = $_SESSION['role'];
}

$categories = query($db, "SELECT * FROM categorie LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTC E-Learning</title>
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

    <!--Début du contenu principal-->

    <main>
        <!--Section des banniere-->

        <section class="banniere">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <img src="images/banniereprincipal.png" alt="image banniere principal" class="w-100 h-100">
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <h1 class="mb-3 fw-bold">
                            Transformez votre avenir avec l'apprentissage en ligne.
                        </h1>
                        <p class="fw-medium my-3">
                            Nous nous sommes donnés pour de fournir un accès équitable à l'éducation pour
                            tous, indépendamment de la localisation géographique, du statut socio-économique ou
                            des capacités physiques.
                        </p>
                        <div class="input-group mt-3 pt-3">
                            <input type="text" placeholder="Ex : Webmaster" class="form-control">
                            <button class="btn btn-primary fw-bold">Rechercher</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Section des particularité-->

        <section>
            <div class="container py-4">
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center align-items-center">
                        <h2 class="border-bottom border-dark border-2 fw-bold">Pourquoi Choisir KTC E-Learning?</h2>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-4 px-2">
                        <div class="d-flex shadow p-3 mb-5 bg-body-tertiary rounded align-items-center">
                            <p class="text-primary pourquoi"><i class="fa-solid fa-video"></i></p>
                            <div class="w-100 px-3">
                                <h4 class="fw-bold">Des Milliers Cours Videos:</h4>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore minus.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2">
                        <div class="d-flex shadow p-3 mb-5 bg-body-tertiary rounded align-items-center">
                            <p class="text-primary pourquoi"><i class="fa-solid fa-chalkboard-user"></i></p>
                            <div class="w-100 px-3">
                                <h4 class="fw-bold">Des Enseignants Expert:</h4>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore minus.adipisicing elit. Labore minus.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 px-2">
                        <div class="d-flex shadow p-3 mb-5 bg-body-tertiary rounded align-items-center">
                            <p class="text-primary pourquoi"><i class="fa-solid fa-folder"></i></p>
                            <div class="w-100 px-3">
                                <h4 class="fw-bold">Une Excellente Documentation:</h4>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore minus.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--A propos-->

        <section class="a-propos" id="propos">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="mb-3 fw-bold border-bottom border-dark border-2">
                            A PROPOS DE KTC-CENTER
                        </h2>
                        <p class="fw-medium my-3">
                            <span class="text-primary fw-bold">KTC-CENTER</span> est une initiative de jeunes ingénieurs camerounais d’Allemagne qui ont
                            décidé d’apporter leur contribution dans la formation des jeunes camerounais, mais
                            aussi de les préparer sur le plan technologique, car le monde est de plus en plus
                            digital. Notre but premier est d’apporter une contribution à l’émergence
                            informatique, à la promotion des TIC dans la société afin de répondre présent face
                            aux défis de l’informatisation, et de l’avènement d’un monde digitalisé.Nous sommes
                            spécialisées dans la prestation de services informatiques à savoir la
                            création/hébergement des sites web et applications, la formation professionnelle en
                            informatique et langues (allemand, Anglais) également des solutions IT.
                            La structure existe légalement en Allemagne en tant qu’ONG spécialisée dans
                            la formation et le transfert des technologies vers les pays en voie de
                            développement (PVD).
                        </p>
                    </div>
                    <div class="col-6">
                        <img src="images/banniere2.png" alt="image banniere principal" class="w-100 h-100">
                    </div>
                </div>
            </div>
        </section>

        <!--Nos Formations-->

        <section class="formations mb-4">
            <div class="container">

                <div class="row py-4">
                    <div class="col d-flex flex-column justify-content-center align-items-center">
                        <h2 class="text-primary fw-bold border-bottom border-primary border-2 mb-3">Nos Formations</h2>
                        <h4>Liste De Differentes Catégories De Nos Formations</h4>
                    </div>
                </div>

                <!--Grids des Categories-->

                <div class="row">
                    <?php foreach ($categories as $categorie) : ?>
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">
                                <img src="images/<?= $categorie['image'] ?>" class="card-img-top" alt="image drapeau">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $categorie['nom'] ?> :</h5>
                                    <p class="card-text"><?= $categorie['description'] ?></p>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="text-decoration-none"><button class="btn btn-primary text-white "><i class="fa-solid fa-arrow-right"></i> Découvrir</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </section>

        <!--Les stats-->

        <section style="background: #e0f7ff;">

            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <img src="images/stats.png" alt="image banniere principal" class="w-100 h-100">
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-start">
                        <h1 class="mb-3 fw-bold border-bottom border-dark border-2">
                            Nos Statistiques :
                        </h1>
                        <p class="fw-medium my-3">
                            <span class="text-primary fw-bold">+ 2000</span> étudiants déja Formés
                        </p>
                        <p class="fw-medium my-3">
                            <span class="text-primary fw-bold">+ 75%</span> de diplomés embauchés en moins de 6 mois
                        </p>
                        <p class="fw-medium my-3">
                            <span class="text-primary fw-bold">+ 8</span> Années d'expérience
                        </p>
                        <p class="fw-medium my-3">
                            <span class="text-primary fw-bold">+ 200</span> étudiants voyageurs
                        </p>
                        <p class="fw-medium my-3">
                            <span class="text-primary fw-bold">+ 30 </span> entreprises partenaires
                        </p>

                    </div>
                </div>
            </div>
        </section>

        <!--temoignage-->

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