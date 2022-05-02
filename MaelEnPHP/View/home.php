<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link href="public/style.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <title>MaelEnPHP</title>
</head>

<body>
 <?php require('navbar.php'); ?>
    <section class="container">
        <div class="row">
        <div class="col-lg-8">
            <h3>Maël Mhun, développeur et prometteur</h3>
            <p> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum."</p></br>
        </div>
        <div class="col-lg-4 ">
            <img src="public/images/portrait.jpg" class="mx-auto d-table img-fluid" width="215" alt="Site logo">
        </div>
        <div class="col-lg-12">
        <button type="button" class="btn btn-pre"  role="button">Voir mon CV</button>
        </div>
        </div>
    </section>
    <?php require('view/footer.php'); ?>

</body>

</html>