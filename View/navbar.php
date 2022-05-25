<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $pagetitle ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="public/style.css"> 
    </head>

<header class="container">
        <div class="row  airmaker">
            <div class="col-lg-6 col-8 text-center d-flex align-items-center">
                <h1>MaelEnPHP, le blog des dev php juniors</h1>
                <!--<?= $content ?>-->
            </div>
            <div class="col-lg-6 col-4">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <button class="navbar-toggler mx-auto align-middle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse align-itemps-center justify-content-center" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto align-middle">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Accueil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="view/ListPostView.php">Voir les posts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="view/login.php">Se connecter</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
