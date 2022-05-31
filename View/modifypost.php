
<?php $pagetitle = htmlspecialchars('Modifier un post - Mael En PHP'); ?>

<?php ob_start(); ?>


    <div class="wrapper">
        <h2>Editer un post</h2>
        <p>Modifier les champs pour éditer le commentaire.</p>
        <form action="index.php?action=postEdit&amp;idPost=<?= $_GET['idPost'] ?> " method="post">
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
                <textarea type="text" name="content" class="form-control <?php echo (!empty($content_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $content; ?>"></textarea>
                <span class="invalid-feedback"><?php echo $content_err; ?></span>
            </div>
            <div class="form-group"><br>
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
