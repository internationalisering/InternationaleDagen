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
        <div class="col-md-2"></div>
        <div class="col-md-8">
                <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Edit</th>   
                            <th scope="col">Remove</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($templates as $template){
                              echo "<tr><th scope=\"row\">" . $template->naam . "</th>
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