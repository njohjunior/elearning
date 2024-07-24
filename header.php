<div class="container">
    <div class="row align-items-center">
        <div class="col-3">
            <a href="index.php">
                <img src="<?= $web_root ?>images/logo.jpg" alt="logo KTC" class="w-50 h-100 logo">
            </a>
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
            <a href="connexion.php" class="text-decoration-none">
                <button class="btn btn-primary fw-bold">
                    <i class="fa-solid fa-right-to-bracket"></i> CONNEXION
                </button>
            </a>
        </div>
    </div>
</div>