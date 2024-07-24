<div class="container">
    <div class="row align-items-center">
        <div class="col-3">
            <a href="<?= $web_root ?>index.php"><img src="<?= $web_root ?>images/logo.jpg" alt="logo KTC" class="w-50 logo"></a>
        </div>
        <div class="col-7">
            <nav class="mt-4">
                <ul class="d-flex justify-content-between list-unstyled">
                    <li>
                        <a href="<?= $web_root ?>index.php" class="text-black text-decoration-none">
                            <i class="fa-solid fa-house"></i> Accueil
                        </a>
                    </li>
                    <li>
                        <a href="<?= $web_root ?>formations.php" class="text-black text-decoration-none">
                            <i class="fa-solid fa-list"></i> Nos Formations
                        </a>
                    </li>
                    <li>
                        <!--Si l'utilisateur est un administrateur-->
                        <?php if ($role == 'administrateurs') : ?>
                            <a href="<?= $web_root ?>admin/dashboard.php" class="text-black text-decoration-none">
                                <i class="fa-solid fa-gear"></i> Dashboard
                            </a>
                        <?php endif; ?>

                        <!--Si l'utilisateur est un enseignant-->
                        <?php if ($role == 'enseignants') : ?>
                            <a href="<?= $web_root ?>admin/gestion_module.php" class="text-black text-decoration-none">
                                <i class="fa-solid fa-gear"></i> Dashboard
                            </a>
                        <?php endif; ?>

                        <!--Si l'utilisateur est un apprenant-->
                        <?php if ($role == 'apprenants') : ?>
                            <a href="<?= $web_root ?>mesCours.php" class="text-black text-decoration-none">
                                <i class="fa-solid fa-file"></i> Mes Cours
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <a href="<?= $web_root ?>contact.php" class="text-black text-decoration-none">
                            <i class="fa-solid fa-address-book"></i> Contacts
                        </a>
                    </li>
                    <li>
                        <a href="apropos.php" class="text-black text-decoration-none">
                            <i class="fa-solid fa-handshake"></i> A Propos
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <div class="dropdown">
                <button class="btn btn-primary text-white fw-bold dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i> COMPTE
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a href="<?= $web_root ?>profil.php" class="dropdown-item text-black text-decoration-none fw-medium">Profil</a>
                    </li>
                    <li>
                        <a href="<?= $web_root ?>deconnexion.php" class="dropdown-item text-danger text-decoration-none fw-bold">DECONNEXION</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>