<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View User</h1>
        </div>
    </div>
    <div class="btn-toolbar pull-right" style="margin-bottom: 10px">
        <div class="btn-group">
            <a href="<?=site_url() ?>gebruiker/edit/<?php echo $user->id; ?>" class="btn btn-default">Edit User</a>
        </div>
        <div class="btn-group">
            <a href="<?=site_url() ?>gebruiker/remove/<?php echo $user->id; ?>" class="btn btn-danger">Delete User</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Title</b>
            <p><?php echo ($user->titel == "" ? "-" : $user->titel); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>First Name</b>
            <p><?php echo ($user->voornaam == "" ? "-" : $user->voornaam); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Last Name</b>
            <p><?php echo ($user->achternaam == "" ? "-" : $user->achternaam); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>E-mail</b>
            <p><?php echo ($user->email == "" ? "-" : $user->email); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Mobile</b>
            <p><?php echo ($user->mobiel == "" ? "-" : $user->mobiel); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Gender</b>
            <p><?php echo ($user->gender == 0 ? "Man" : "Woman"); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Account Type</b>
            <p><?php echo $user->type->naam; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Institution</b>
            <p><?php echo ($user->institutie == "" ? "-" : $user->institutie); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Country</b>
            <p><?php echo ($user->land == "" ? "-" : $user->land); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Position</b>
            <p><?php echo ($user->positie == "" ? "-" : $user->positie); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Study Field</b>
            <p><?php echo ($user->studieGebied == "" ? "-" : $user->studieGebied); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Your biography</b>
            <p><?php echo ($user->biografie == "" ? "-" : $user->biografie); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Name of Thomas More contact person</b>
            <p><?php echo ($user->tmContact == "" ? "-" : $user->tmContact); ?></p>
        </div>
    </div>
    <br><br>
</div>