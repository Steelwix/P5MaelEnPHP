
<?php $pagetitle = htmlspecialchars('Contact'); 
 ob_start(); ?>
 <div class="container formpage">
     <div class="row">
     <div class="col-12">
    <h2>Contact</h2>
    <p>Dites nous tout.</p>
    <form action="index.php?action=sendMessage" method="post">
        <div class="form-group">
<?php
 if(isset($_SESSION['email']))
{
}
else { ?>

            <label>Email</label>
            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
<?php
}
   ?>            <label>Votre message</label>
   <textarea type="text" name="message" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>"></textarea>
   <span class="invalid-feedback"><?php echo $message_err; ?></span>
<div class="form-group"><br>
   <input type="submit" class="btn btn-primary" value="Submit">
   <input type="reset" class="btn btn-secondary ml-2" value="Reset">
</div>
</div>
</form>
</div>
</div>
</div> 
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
