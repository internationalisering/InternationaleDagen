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
                    <form role="form" method="POST" action="<?= site_url(); ?>/reset/email">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Send email</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>