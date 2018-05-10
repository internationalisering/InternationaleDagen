<!-- TIJDELIJKE STYLE! Moet naar style.css... -->
<script>

$(document).ready(function()
{   


    $('.planning-child-tick').click(function(obj)
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
                $(object).addClass('planning-child-activity-enrolled');
                $(object).removeClass('planning-child-activity-not-enrolled');
            }
            else 
            {   
                $(object).addClass('planning-child-activity-not-enrolled');
                $(object).removeClass('planning-child-activity-enrolled');
            }
        }
        
    });
}

function feedback()
{
    $('.planning-feedback').slideDown();
}

function feedbackSubmit(sessionId)
{
     $.ajax({
        url: site_url() + "/planning/feedback/" + sessionId, 
        data: {feedback: $('#feedback').val()},
        type: "POST",

        success: function(result)
        {
            $('.planning-feedback').slideUp();
        }

    }); 


}

//function 



</script> 


<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav"><?= $titel ?>  <button class="btn btn-primary" onclick="showHelp();"><i class="fas fa-question-circle"></i></button></h3>
        </div>
    </div>
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
            <div class="planning-flexbox">
                   <?php 
                        $datumsBereik = new DatePeriod (
                            new DateTime($edition->startdatum),
                            new DateInterval('P1D'),
                            new DateTime($edition->einddatum)
                            );
                            
                        foreach ($datumsBereik as $datumKey => $datum) {  // Voor elke datum 
                            ?> 
                            <div class='planning-date'>
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
                                    <div class='planning-line-break'></div> <!-- Zorgt voor expliciete break tussen flexboxes-->
                                    <div class='planning-time'>
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
                                                    <div class='planning-child planning-child-break'>
                                                        <p class='planning-session-title'>
                                                            <?= $column->pauze ?>
                                                        </p>

                                                    </div>
                                                <?php 
                                            } else {
                                                ?> 
                                                    <?php 

                                                    ?>
                                                    <div class='planning-child planning-child-activity planning-child-activity-<?= ($column->ingeschreven?'':'not-')?>enrolled' data-column-id=<?= $column->id ?>>
                                                        <div class='planning-session'>
                                                            <p class='planning-session-title'><?= $column->session->titel ?></p>
                                                            <p class='planning-session-author'>
                                                                <?= $column->session->gebruiker->voornaam ?>
                                                                <?= $column->session->gebruiker->achternaam ?>
                                                            </p>  


                                                            <span class='planning-child-tick' data-column-id=<?= $column->id ?>>
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