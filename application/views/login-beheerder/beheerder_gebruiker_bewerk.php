<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $h1; ?></h1>
        </div>
    </div>
    <?php
    if(isset($user->id)){
        echo '
            <div class="btn-toolbar pull-right" style="margin-bottom: 10px">
                <div class="btn-group">
                    <a href="'. site_url() . '/gebruiker/view/' . $user->id . '" class="btn btn-default">View User</a>
                </div>
                <div class="btn-group">
                    <a href="'. site_url() . '/gebruiker/remove/' . $user->id . '" class="btn btn-danger">Delete User</a>
                </div>
            </div>
        ';
    }
    ?>
    <form role="form" method="POST">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="e.g. Dr." value="<?php echo $user->titel; ?>" name="titel">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" value="<?php echo $user->voornaam; ?>" name="voornaam">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" value="<?php echo $user->achternaam; ?>" name="achternaam">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control" placeholder="e.g. example@example.com" value="<?php echo $user->email; ?>" name="email">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Mobile</label>
                    <input class="form-control" value="<?php echo $user->mobiel; ?>" name="mobiel">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        <option value="0"<?php echo $user->gender == 0 ? " selected" : ""; ?>>Man</option>
                        <option value="1"<?php echo $user->gender == 1 ? " selected" : ""; ?>>Woman</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Account Type</label>
                    <select class="form-control" name="typeId">
                        <?php
                        foreach($types as $type){
                            echo '<option value="' . $type->id . '"' . ($user->typeId == $type->id ? " selected" : "") . '>' . $type->naam . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Institution</label>
                    <input class="form-control" placeholder="e.g. Thomas More" value="<?php echo $user->institutie; ?>" name="institutie">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Country</label>
                    <input class="form-control" placeholder="e.g. Belgium" value="<?php echo $user->land; ?>" name="land">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Position</label>
                    <input class="form-control" placeholder="e.g. Professor" value="<?php echo $user->positie; ?>" name="positie">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Study Field</label>
                    <input class="form-control" value="<?php echo $user->studieGebied; ?>" name="studieGebied">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Your biography</label>
                    <textarea class="form-control" rows="3" name="biografie"><?php echo $user->biografie; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Name of Thomas More contact person</label>
                    <input class="form-control" value="<?php echo $user->tmContact; ?>" name="tmContact">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                </div>
                <div class="btn-group">
                    <a href="<?=site_url() ?>/gebruiker" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
        <br><br>
    </form>
</div>