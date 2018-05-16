<?php
/**
 * @file edit_tables.php
 * @author Quinten van Casteren
 * 
 * Pagina met een form waarin een hulptabel kan opgegeven worden.
 * 
 * @see Tables
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?=$type;?></h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="<?= site_url() . "/tables/change" . $type;?>">
                        <fieldset>
                            <div class="form-group">
                                <label>Name: </label><input class="form-control" value="<?php if($template != null) {if ($type == "Class"){echo $template->klasgroep;} Else {echo $template->naam;}} ?>" name="naam" type="text" required>
                                <input class="hidden" name="id" value="<?php if($template != null) {echo $template->id;}else{echo "new";}  ?>">
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Submit <?=$type;?></button>
                            <a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/tables">Cancel</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>