
<?php $pagetitle = htmlspecialchars('Contact'); 
 ob_start(); 

 if(isset($_SESSION['email']))
{ ?>
       <div class="wrapper">
    <h2>Contact</h2>
    <p>Please fill this form to create an account.</p>
    <form action="index.php?action=sendMessage" method="post">
        <div class="form-group">
            <label>Votre message</label>
            <input type="text" name="message" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>">
            <span class="invalid-feedback"><?php echo $message_err; ?></span>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
</div> 
<?php
}
else { ?>
    <div class="wrapper">
    <h2>Contact</h2>
    <p>Please fill this form to create an account.</p>
    <form action="index.php?action=sendMessage" method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <label>Votre message</label>
            <input type="text" name="message" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $message; ?>">
            <span class="invalid-feedback"><?php echo $message_err; ?></span>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
</div> 
<?php
}
   ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
