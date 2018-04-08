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
        <div class="col-md-2"></div>
        <div class="col-md-8">
                <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Language</th>   
                            <th scope="col">Length</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($lectures as $lecture){
                              echo "<tr><th scope=\"row\">" . $lecture->titel . "</th>
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