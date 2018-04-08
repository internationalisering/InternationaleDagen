<?php
/**
 * @file edit_lectures.php
 * @author Quinten van Casteren
 * 
 * Pagina met een form waarin de lecture kan opgegeven worden.
 * 
 * @see Lectures
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Lecture</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="<?= site_url(); ?>/Lectures/change">
                        <fieldset>
                            <div class="form-group">
                                <label>Title: </label><input class="form-control" value="<?php if($lecture != null) {echo $lecture->titel;} ?>" name="titel" type="text" required>
                                <label>Content: </label><textarea class="form-control" rows="5" name="inhoud" required ><?php if($lecture != null) {echo $lecture->inhoud;} ?></textarea>
                                <label>Field: </label><input class="form-control" value="<?php if($lecture != null) {echo $lecture->studieGebied;} ?>" name="studiegebied" type="text" required>
                                <label>Duration (in minutes): </label><input class="form-control" value="<?php if($lecture != null) {echo $lecture->duur;} ?>" name="duur" type="number" required>
                                <input class="hidden" name="id" value="<?php if($lecture != null) {echo $lecture->id;}else{echo "new";}  ?>">
                                <label>Language: </label><select name="taal">
                                        <?php foreach($talen as $taal){
                                            if($taal->id == $lecture->taalId){
                                                echo "<option selected value=\"" . $taal->id . "\">" . $taal->naam . "</option>";
                                            }else{
                                                echo "<option value=\"" . $taal->id . "\">" . $taal->naam . "</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <button class="btn btn-lg btn-success btn-block" type="submit" name="send" value="Submit">Submit Lecture</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>