<div id="page-wrapper" class="page-wrapper-fullpage">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav">Lijst van edities</h3>
        </div>
    </div>

    <div class="row intro text">
        <div class="col-lg-12 col-md-12">
            <table>
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
</div>

<style>
    table {
    border-collapse: collapse;
    width: 100%;
    text-align: center;
    font-family: 'Verdana';
}

table, th, td {
    border: 1px solid black;
    padding: 1%;
}

table a, table a:hover {
        text-decoration: none;
    color: #ffffff;
}
</style>