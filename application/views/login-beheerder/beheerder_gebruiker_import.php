<?php
/**
 * @file beheerder_gebruiker_import.php
 * 
 * Pagina waar de beheerder gebruikers kan importeren.
 */
?>
<div id="page-wrapper">

<h1 class="page-header"><?php echo $h1; ?></h1>

<form class="col-md-4 col-md-offset-4 upload" action="<?php echo site_url();?>/csv/importcsv" method="post" enctype="multipart/form-data" name="form1" id="form1">

    <table class="import">
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


<label id="typeUser">Choose the type of user you want to import: </label>
  <select name="type">
      <?php
      foreach ($type as $t) {
          echo "<option value='" . $t->id . "'>" . $t->naam . "</option>";
      }
      ?>
  </select>

  <button type="button" id="help" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" title="Hoe maak ik van Excelfile een CSV bestand?">
  <i class="fas fa-question-circle"></i>
</button>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Hoe converteer ik een xlsx-bestand naar een CSV-file?</h3>
                </div>
        <div class="modal-body">
        <p>We zullen je in deze korte handleiding wegwijs maken in het importeren van een CSV-bestand en hoe je nu juist zo een bestand maakt.</p>

        <p>Eerst open je Excel op je computer</p>
        <p>Het icoon ziet er zo uit: <img src="<?= base_url(); ?>/resources/images/Excel.png" id="icon" alt="Excellogo"></p>
        <p>Eens je Excel hebt geopend heb je de keuze om: </p>
        <ul>
          <li><b>Een bestand te openen dat al bestaat</b></li>
            <ul><li>Dit doe je door te klikken op "Bestand" linksboven en vervolgens te drukken op "Openen"</li></ul>
          <li><b>Een bestand zelf aan te maken</b></li>
          <ul><li>Dit doe je door te klikken op "Bestand" linksboven en vervolgens te drukken op "Nieuw"</li></ul>
        </ul>
        <hr>
        <p>Wij gaan in deze handleiding werken met al reeds bestaande Excel bestanden. Dus we kiezen voor "Openen"</p>
        <p>Het belangrijkste bij het converteren van Excel file is dat het specifieke <b>kolomnamen</b> moet hebben.</p>
        <p>Deze zijn:</p>
        <p><img src="<?= base_url(); ?>/resources/images/kolomnamen.png" id="kolomnamen" alt="kolomnamen"></p>
        <ul>
          <li>Zolang deze kolomnamen hetzelfde zijn als in jouw Excel bestand, kan er niet veel mislopen.</li>
          <li>Zodra de kolomnamen in orde zijn, moet je zien of de gegevens overeenkomen met de betreffende kolommen.</li>
        </ul>
        <p>Dus elke gebruiker heeft een voornaam, een achternaam, een emailadres enzovoort...</p>
        <hr>
        <p>Nu kunnen we het bestand converteren.</p>
        <p>Klik nu eerst op "Bestand" en druk daarna op <b>Opslaan als</b>.</p>
        <p>Je krijgt nu dit dialoogvenster te zien:</p>
        <img src="<?= base_url(); ?>/resources/images/OpslaanAls.png" alt="DialoogExcel" id="OpslaanAls">
        <hr>
        <p>In dit dialoogvenster zie je selectbox onder de naam van jouw bestand. Als je daar op klik krijg je een hele lijst te zien.</p>
        <p>Hieruit kies je <b>CSV (gescheiden door lijstscheidingsteken (*.csv)</b></p>
        <p>Klik daarna op <b>Opslaan</b>.</p>
        <p><b>Klaar! </b>Je hebt nu een Excel bestand geconverteerd naar een CSV file.</p>


        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</form>

</div>
