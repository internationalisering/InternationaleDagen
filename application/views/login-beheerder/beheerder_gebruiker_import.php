<div id="page-wrapper">

<h1 class="page-header"><?php echo $h1; ?></h1>

<form class="col-md-4 col-md-offset-4 upload" action="<?php echo site_url();?>/csv/importcsv" method="post" enctype="multipart/form-data" name="form1" id="form1">

    <table>
        <tr>
            <td> Choose your file: </td>
            <td>
                <input type="file" class="form-control" name="userfile" id="userfile"  align="center"/>
            </td>
            <td>
                <div class="col-lg-offset-3 col-lg-9">
                    <button type="submit" name="submit" class="btn btn-info">Upload</button>
                </div>
            </td>
        </tr>
    </table>

<p>
<label id="typeUser">Kies hier het type gebruiker dat je wilt importeren: </label>
  <select name="type">
      <?php
      foreach ($type as $t) {
          echo "<option value='" . $t->id . "'>" . $t->naam . "</option>";
      }
      ?>
  </select>
</p>
</form>

</div>

<style>

.upload {
    position: absolute;
    top: 30%;
    right:0;
    left:0;
    background-color: #f9f9f9;
    padding: 2%;
    width: 600px;
    border-radius: 25px;
}

#typeUser {
  padding: 2%;
}

</style>
