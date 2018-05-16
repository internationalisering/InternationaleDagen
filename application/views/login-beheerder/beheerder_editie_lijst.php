<?php
/**
 * @file beheerder_editie_lijst.php
 * 
 * Pagina waar de beheerder alle edities kan bekijken.
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">

    <div class="row">
    <div class="col-lg-12">
            <h1 class="page-header">List of editions</h1>
        </div>
    </div>

    <?php $this->notifications->buildNotification(); ?>

    <div class="row intro text">
        <div class="col-lg-12 col-md-12">
            <table class=""editietable>
                <th>Edition</th>
                <th>Student Count</th>
                <th></th>
            <?php

            foreach($edition as $ed){
                $str = $ed->startdatum;
                $time = strtotime(($str));
                $year = date("Y", $time);

                echo "<tr>
                    <td>" . "International Days " . $year . "</td>
                    <td>" . $ed->maxHoeveelheid . "</td>
                    <td>" . "<button type='button' class='btn btn-danger'><a href=" . site_url()  . "/home/homepagina_view/" . $ed->id . ">Edit homepage</button>" . "</td>
                </tr>";
                }
            ?>
            </table>



        </div>
    </div>
<h1 class="page-header">Add a new edition </h1>
<div class="col-lg-12 col-md-12" id="newEdition">

<form action="<?= site_url()?>/home/editieToevoegen" method="POST">
  <table class="editietable">
    <tr>
      <td align="right">From:</td>
      <td align="left"><input type="date" name="dateFrom"  value="<?php echo date('Y-m-d'); ?>"/></td>
    </tr>
    <tr>
      <td align="right">To:</td>
      <td align="left"><input type="date" name="dateTo"  value="<?php echo date('Y-m-d'); ?>"/></td>
    </tr>
    <tr>
      <td align="right">Student count:</td>
      <td align="left"><input type="text" name="aantalLeerlingen" /></td>
    </tr>
  </table>

        <div class="row" id="groupButton">
            <div class="col-lg-12">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Create</button>
                </div>
            </div>
        </div>
        </div>
</form>


</div>