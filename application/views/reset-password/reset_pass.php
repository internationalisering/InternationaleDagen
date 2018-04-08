<?php
/**
 * @file reset_pass.php
 * @author Quinten van Casteren
 * 
 * Pagina waar we ons nieuwe wachtwoord opgeven dit aan te passen in onze database.
 * 
 * @see Reset
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Reset Password</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if(isset($error)){
                        ?>
                        <div class="alert alert-danger alert-dismissible show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <?php
                    }
                    ?>
                    <form role="form" method="POST" action="<?= site_url(); ?>/reset/pass">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                <input class="form-control" placeholder="Confirm Password" name="confirmpassword" type="password" value="">
                                <input class="hidden" name="code" value="<?php echo $code;  ?>">
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Reset Password</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>