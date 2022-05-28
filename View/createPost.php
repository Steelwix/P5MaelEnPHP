
<?php $pagetitle = htmlspecialchars('Créer un post'); ?>

<?php ob_start(); ?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer un post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <h2>Créer un post</h2>
        <p>Remplissez les champs pour créer un post.</p>
        <form action="index.php?action=newPost" method="post">
            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                <span class="invalid-feedback"><?php echo $title_err; ?></span>
            </div>
            <div class="form-group">
                <label>Chapo</label>
                <input type="text" name="hat" class="form-control <?php echo (!empty($hat_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hat; ?>">
                <span class="invalid-feedback"><?php echo $hat_err; ?></span>
            </div>
            <div class="form-group">
                <label>Contenu</label>
                <input type="text" name="content" class="form-control <?php echo (!empty($content_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $content; ?>">
                <span class="invalid-feedback"><?php echo $content_err; ?></span>
            </div>
            <div class="form-group">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
