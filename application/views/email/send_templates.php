<?php
/**
 * @file edit_templates.php
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
                    <form role="form" method="POST" action="<?= site_url(); ?>/email/change">
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
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Submit Email Template</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>