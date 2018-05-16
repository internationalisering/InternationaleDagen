<?php
/**
 * @file beheerder_editie_toevoegen.php
 * 
 * Pagina waar de beheerder de edities kan toevoegen.
 */
?>
<form role="form" method="POST">
  <table>
    <tr>
      <td align="right">Van:</td>
      <td align="left"><input type="date" name="dateFrom"  value="<?php echo date('d-m-Y'); ?>"/></td>
    </tr>
    <tr>
      <td align="right">Tot:</td>
      <td align="left"><input type="date" name="dateTo"  value="<?php echo date('d-m-Y'); ?>"/></td>
    </tr>
    <tr>
      <td align="right">Aantal leerlingen:</td>
      <td align="left"><input type="text" name="aantalLeerlingen" /></td>
    </tr>
  </table>

  <div class="row">
            <div class="col-lg-6">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Create</button>
                </div>
                <div class="btn-group">
                    <a href="<?=site_url() ?>/gebruiker" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
</form>
