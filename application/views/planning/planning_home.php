<!-- TIJDELIJKE STYLE! Moet naar style.css... -->

    <style>

.flexbox
{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 10px;
}

.child
{
  display: inline-block;
  font-size: 20px;
  color: #FFF;
  text-align: center;
  background: #3794fe;
  border-radius: 6px;
  padding: 0px;
  margin: 12px;
  flex: 1;
  font-family: "Open Sans", Arial;

}
.session-title 
{
    font-size: 20px;  

}

.session-author 
{
    font-size: 12px;  
}


.child-tick
{
    color: white;
    float: right;
    right: 0;
    bottom: 0;
}

.child-activity 
{
    background: #3794fe;
}
.child-break
{
    background: #FF7300;

}

.line-break 
{
    width: 100%;
}


.date 
{
    display: inline-block;
    width:100%;
    border-bottom: 1px solid #cecece;
}
.time
{
    margin: 12px;
    display:inline-block;
    width:15%;
}
</style>

<script>

$(document).ready(function()
{
    $('.child-tick').click(function(obj)
    {
        var columnId = $(this).data('column-id');
        alert('Column id aangeklikt: '+columnId);
    })
});



</script>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal">Open Modal</button>


<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav"><?= $titel ?></h3>
        </div>
    </div>
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
            <div class="flexbox">
                   <?php 
                        $datumsBereik = new DatePeriod (
                            new DateTime($edition->startdatum),
                            new DateInterval('P1D'),
                            new DateTime($edition->einddatum)
                            );
                            
                        foreach ($datumsBereik as $datumKey => $datum) {  // Voor elke datum 
                            ?> 
                            <div class='date'>
                                <h2><?= $datum->format('l\, d M Y') ?></h2>
                            </div>



                            <?php 

                            // Voor elke rij...
                            foreach($rows as $row)
                            {
                                // Voor elke dag gaan we kijken welke rijen op deze dag vallen.
                                if($datum->format("Y-m-d") == date("Y-m-d", strtotime($row->starttijd)))
                                {

                                   
                                    ?>
                                    <div class='line-break'></div> <!-- Zorgt voor expliciete break tussen flexboxes-->
                                    <div class='time'>
                                         <p> 
                                            <?= date("H\ui", strtotime($row->starttijd)); ?>
                                            -
                                            <?= date("H\ui", strtotime($row->eindtijd)); ?> 
                                        </p>
                                        <hr>
                                    </div>
                                    <?php 



                                    foreach($row->columns as $column)
                                    {

                                        if($row->id == $column->planningRijId) // Kolom rij id komt overeen met rij id?
                                        {

                                            if(isset($column->pauze)) // Is het een pauze? 
                                            {
                                                ?> 
                                                    <div class='child child-break'>
                                                        <p class='session-title'>
                                                            <?= $column->pauze ?>
                                                        </p>

                                                    </div>
                                                <?php 
                                            } else {
                                                ?> 
                                                    <div class="child child-activity">
                                                        <div class='session'>
                                                            <p class='session-title'><?= $column->session->titel ?></p>
                                                            <p class='session-author'>
                                                                <?= $column->session->gebruiker->voornaam ?>
                                                                <?= $column->session->gebruiker->achternaam ?>
                                                            </p>  


                                                            <span class='child-tick' data-column-id=<?= $column->id ?>>
                                                                v&nbsp;
                                                            </span>

                                                        </div>
                                                    </div>
                                                <?php      
                                            }

                                            

                                
                                        }

                                    }  


                    

                                

                                }

                            }

                        }
                            
                        ?>       
    </div>
</div>
</div>
</div>