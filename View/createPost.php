
<?php $pagetitle = htmlspecialchars('Créer un post'); ?>

<?php ob_start(); ?>

 
<div class="container">
    <div class="row">
        <div class="col-12"><br>

        <h2>Créer un post</h2>
        <p>Remplissez les champs pour créer un post.</p>
        <form action="index.php?action=newPost" method="post">
            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="title" class="form-control <?= (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($title) ?>">
                <span class="invalid-feedback"><?= $title_err; ?></span>
            </div>
            <div class="form-group">
                <label>Chapo</label>
                <input type="text" name="hat" class="form-control <?= (!empty($hat_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($hat) ?>">
                <span class="invalid-feedback"><?= $hat_err; ?></span>
            </div>
            <div class="form-group">
                <label>Contenu</label>
                <textarea type="text" name="content" class="form-control <?= (!empty($content_err)) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($content) ?>"></textarea>
                <span class="invalid-feedback"><?= $content_err; ?></span>
            </div>
            <div class="form-group"><br>
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div><br>
        </form>  </div></div></div>  
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
