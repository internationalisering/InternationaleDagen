<?php
/**
 * @file show_lectures.php
 * @author Quinten van Casteren
 * 
 * Pagina waar de spreker zijn lectures kan zien.
 * 
 * @see Lectures
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-lectures">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Language</th>   
                            <th>Length</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($lectures as $lecture){
                              echo "<tr class= \"odd gradeX\"><th>" . $lecture->titel . "</th>
                            <td>" . $lecture->taal->naam . "</td>
                            <td>" . $lecture->duur . " min</td>
                            <td><a class=\"btn btn-sm btn-success btn-block\" href=\"" . site_url() . "/lectures/edit/" . $lecture->id ."\">Edit</a></td></tr>";
                          } ?>
                        </tbody>
                      </table>
            <p><a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/lectures/edit/new">New Lecture</a></p>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#tabel-lectures').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: [3],
                orderable: false
            }
        ]
    });
});
</script>