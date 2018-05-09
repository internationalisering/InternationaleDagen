<?php
/**
 * @file edit_template.php
 * @author Quinten van Casteren
 * 
 * Pagina waar de beheerder een email kan verzenden.
 * 
 * @see Email
 */
?>

<script>
    $(document).ready(function(){

        $( "#templateSelect" ).change(function() {
            var dataInt = $(this).val();
            
            $.ajax({type : "GET",
                url : site_url() + "/email/haalAjaxOp_Templates",
                data : { zoekstring : dataInt},
                success : function(result){
                    $("#show").html(result);
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
        });
      });
    });

</script>

<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Email:</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="<?= site_url(); ?>/email/finish">
                        <fieldset>
                            <div class="form-group">
                                <label>Select a template: </label>
                                <select name="template" id="templateSelect">
                                    <option disabled selected value> Templates: </option>
                                    <?php 
                                    foreach($templates as $template){
                                        echo "<option value=\"" . $template->id . "\" >" . $template->naam . "</option>";
                                    }
                                    ?>
                                </select>
                                <hr>
                                <div id="show">
                                </div>
                                <ul class="nav nav-tabs">
                                    
                                    <?php 
                                    foreach ($types as $type){
                                        echo "<li><a data-toggle=\"tab\" href=\"#menu" . $type->id . "\">" . $type->naam . "</a></li>";
                                    }
                                    ?>
                                </ul>

                                <div class="tab-content">
                                    
                                        <?php 
                                        foreach ($types as $type){
                                            echo "<div id=\"menu" . $type->id . "\" class=\"tab-pane fade\">";
                                            echo "<div class=\"form-check\"><input class=\"form-check-input\" type=\"checkbox\" id=\"checktype" . $type->id . "\" name=\"checktype" . $type->id . "\">
                                                               <label class=\"form-check-label\" for=\"checktype" . $type->id . "\">All</label></div>";
                                                foreach ($users as $user){
                                                    if ($user->typeId == $type->id){
                                                        echo  "<div class=\"form-check\"><input class=\"form-check-input\" type=\"checkbox\" id=\"check" . $user->id . "\" name=\"check" . $user->id . "\">
                                                               <label class=\"form-check-label\" for=\"check" . $user->id . "\">" . $user->achternaam . " " . $user->voornaam . "</label></div>";
                                                    }
                                                }
                                            echo"</div>";
                                            }
                                        ?>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Submit Email Template</button> <a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/email">Cancel</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>