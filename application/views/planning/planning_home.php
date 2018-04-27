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
  border-radius: 6px;
  padding: 0px;
  margin: 12px;
  flex: 1;
  font-family: "Open Sans", Arial;

}

.img-16
{
    width: 16px;
    height: 16px;
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
    margin-right: 0;
    margin-bottom: 0;
    cursor: pointer;
}

.child-activity 
{
}

.child-activity-enrolled
{
  background: #2BA100;
}

.child-activity-not-enrolled
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
.feedback
{
    display: none;
}
.students 
{
    display: none;
}
</style>

<script>

$(document).ready(function()
{   


    $('.child-tick').click(function(obj)
    {
        var columnId = $(this).data('column-id');
        viewColumn(columnId);
    })

});

function viewColumn(columnId)
{
    $.ajax({
        url: site_url() + "/planning/viewColumn/" + columnId, 
        success: function(result){
        $('#modal-content').html(result);
        $('#modal').modal();

    }});
}

function showHelp()
{
    $.ajax({
        url: site_url() + "/planning/help/", 
        success: function(result){
        $('#modal-content').html(result);
        $('#modal').modal();

    }});
}

function btnEnrolledStudents()
{
    $('#enrolledStudents').slideToggle();
}

function enroll(columnId)
{

    $.ajax({
        url: site_url() + "/planning/enroll/" + columnId, 
        success: function(result){
            viewColumn(columnId);
            setEnrolled(columnId, true);

    }});  
}

function withdraw(columnId)
{

    $.ajax({
        url: site_url() + "/planning/withdraw/" + columnId, 
        success: function(result){
            viewColumn(columnId);
            setEnrolled(columnId, false);

    }});  
}


function setEnrolled(columnId, bool)
{

    $('.child-activity').each(function(index, object)
    {
        var _columnId = $(object).data('column-id');
        if(columnId == _columnId )
        {
            if(bool)
            {
                $(object).addClass('child-activity-enrolled');
                $(object).removeClass('child-activity-not-enrolled');
            }
            else 
            {   
                $(object).addClass('child-activity-not-enrolled');
                $(object).removeClass('child-activity-enrolled');
            }
        }
        
    });
}

function feedback()
{
    $('.feedback').slideDown();
}

function feedbackSubmit(sessionId)
{
     $.ajax({
        url: site_url() + "/planning/feedback/" + sessionId, 
        data: {feedback: $('#feedback').val()},
        type: "POST",

        success: function(result)
        {
            $('.feedback').slideUp();
            console.log('ok', result);
        }

    }); 


}

//function 




</script>
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
                                                    <?php 

                                                    ?>
                                                    <div class='child child-activity child-activity-<?= ($column->ingeschreven?'':'not-')?>enrolled' data-column-id=<?= $column->id ?>>
                                                        <div class='session'>
                                                            <p class='session-title'><?= $column->session->titel ?></p>
                                                            <p class='session-author'>
                                                                <?= $column->session->gebruiker->voornaam ?>
                                                                <?= $column->session->gebruiker->achternaam ?>
                                                            </p>  


                                                            <span class='child-tick' data-column-id=<?= $column->id ?>>
                                                                <img class='img-16' src='<?= base_url() ?>/resources/images/tick.png'/>&nbsp;
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