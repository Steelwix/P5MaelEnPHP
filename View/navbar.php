<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Mael En PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
      $currentUser = $_SESSION['username']; ?>
      <!-- ONLINE NAVBAR -->

      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">A propos</a>
          </li>
          <?php if ($_SESSION['isAdmin'] == 1) { ?> <li class="nav-item">
              <a class="nav-link" href="index.php?action=admincell&amp;">Tableau d'administration</a>
            </li>
          <?php } else {
          }
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><b><?= htmlspecialchars($currentUser) ?></b></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="index.php?action=logout&amp;">Se déconnecter</a>
              <a class="dropdown-item" href="index.php?action=editUser&amp;id=<?= $_SESSION['id'] ?>">Paramètres</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="index.php?action=inspectUserSelf&amp;id=<?= $_SESSION['id'] ?>">Supprimer le compte</a>
            </div>
          </li>
        <?php } else { ?>
          <!-- OFFLINE NAVBAR -->

          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=login&amp;">Se connecter</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=register&amp;">S'inscrire</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=contact">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">A propos</a>
              </li>
            <?php } ?>

            </ul>
          </div>
      </div>
</nav>