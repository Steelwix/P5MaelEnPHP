<footer class="bg-dark text-center text-white">
  <br>
  <!-- Grid container -->
  <div class="container">
    <div class="row">
      <!-- Section: Social media -->
      <div class="col-3">
        <a href="https://twitter.com/MhunM" class="icoTwitter" title="Twitter"><i class="fa fa-2x fa-twitter"></i></a>
      </div>
      <div class="col-3">
        <a href="https://www.instagram.com/steelwix" class="icoInstagram" title="Instagram"><i class="fa fa-2x fa-instagram"></i></a>
      </div>
      <div class="col-3">
        <a href="https://www.linkedin.com/in/maël-mhun-8a68b1156/" class="icoLinkedin" title="Linkedin"><i class="fa fa-2x fa-linkedin"></i></a>
      </div>
      <div class="col-3">
        <a href="https://github.com/Steelwix" class="icoGithub" title="Github"><i class="fa fa-2x fa-github"></i></a>
      </div>
    </div>
  </div>
  <br><br>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <ul class="navbar-nav me-auto">
          <?php if (isset($gSession['loggedin']) && $gSession['loggedin'] === true) {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">A propos</a>
            </li>
            <?php if ($gSession['isAdmin'] == 1) { ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=admincell">Tableau d'administration</a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=welcome">Paramètres du compte</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=login&amp;">Se connecter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=register&amp;">S'inscire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">A propos</a>
            </li>
          <?php } ?>
          <p class="copyright">Mael En PHP © 2022</p>
      </div>
    </div>
  </div>
</footer>