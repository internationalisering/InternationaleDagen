<?php
/**
 * @file show_tables.php
 * @author Quinten van Casteren
 * 
 * Pagina waar de beheerder alle hulptabellen kan zien.
 * 
 * @see Tables
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">Tables </h1>
                <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-types">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($types as $type){
                              echo "<tr class= \"odd gradeX\"><th>" . $type->naam . "</th>
                            <td><a href=\"" . site_url() . "/tables/edittype/" . $type->id . "\"><i class=\"far fa-edit\"></i></a></td></tr>";
                          } ?>
                        </tbody>
                      </table>
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-languages">
                        <thead>
                          <tr>
                            <th>Language</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($languages as $language){
                              echo "<tr class= \"odd gradeX\"><th>" . $language->naam . "</th>
                            <td><a href=\"" . site_url() . "/tables/editlanguage/" . $language->id . "\"><i class=\"far fa-edit\"></i></a> <a href=\"" . site_url()  . "/tables/removelanguage/" . $language->id . "\"><i class=\"far fa-trash\"></i></a></td></tr>";
                          } ?>
                        </tbody>
                      </table>
            <p><a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/tables/editlanguage/new">New language</a></p>
            <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-classes">
                        <thead>
                          <tr>
                            <th>Class</th>
                            <th>Edition</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($classes as $class){
                              echo "<tr class= \"odd gradeX\"><th>" . $class->klasgroep . "</th><th>";
                              foreach ($editions as $edition){
                              if ($edition->id == $class->editieId){
                                  echo $edition->startdatum;
                              }
                              }
                              echo "</th><td><a href=\"" . site_url() . "/tables/editclass/" . $class->id . "\"><i class=\"far fa-edit\"></i></a> <a href=\"" . site_url()  . "/tables/removeclass/" . $class->id . "\"><i class=\"far fa-trash\"></i></a></td></tr>";
                          } ?>
                        </tbody>
                      </table>
            <p><a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/tables/editclass/new">New class</a></p>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#tabel-types').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: [1],
                orderable: false
            }
        ]
    });
    $('#tabel-languages').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: [1],
                orderable: false
            }
        ]
    });
    $('#tabel-classes').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: [2],
                orderable: false
            }
        ]
    });
});
</script>