<?php
/**
 * @file show_templates.php
 * @author Quinten van Casteren
 * 
 * Pagina waar alle emailtemplates getoont worden.
 * 
 * @see Email
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
<div class="row">
<div class="col-lg-12">
            <h1 class="page-header">Manage emails</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tabel-templates">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Edit</th>   
                            <th>Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($templates as $template){
                              echo "<tr class= \"odd gradeX\"><th>" . $template->naam . "</th>
                            <td>" . $template->onderwerp . "</t<>
                            <td><a class=\"btn btn-sm btn-success btn-block\" href=\"" . site_url() . "/email/edit/" . $template->id ."\">Edit</a></td>
                            <td><a class=\"btn btn-sm btn-success btn-block\" href=\"" . site_url() . "/email/remove/" . $template->id ."\">Remove</a></td></tr>";
                          } ?>
                        </tbody>
                      </table>
            <p><a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/email/edit/new">New email template</a></p>
            <p><a class="btn btn-lg btn-success btn-block" href="<?=site_url() ?>/email/send">Send Email</a></p>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#tabel-templates').DataTable({
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