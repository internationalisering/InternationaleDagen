<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Template:</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="<?= site_url(); ?>/email/change">
                        <fieldset>
                            <div class="form-group">
                                <label>Name: </label><input class="form-control" value="<?php if($template != null) {echo $template->naam;} ?>" name="naam" type="text" required>
                                <label>Subject: </label><input class="form-control" value="<?php if($template != null) {echo $template->onderwerp;} ?>" name="onderwerp" type="text" required>
                                <label>Content: </label><textarea class="form-control" rows="15" name="inhoud" required ><?php if($template != null) {echo $template->inhoud;} ?></textarea>
                                <input class="hidden" name="id" value="<?php if($template != null) {echo $template->id;}else{echo "new";}  ?>">
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Submit Email Template</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>