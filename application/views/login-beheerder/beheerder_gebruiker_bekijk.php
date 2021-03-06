<?php
/**
 * @file beheerder_gebruiker_bekijk.php
 * @author Brend Simons
 * 
 * Pagina die te zien is wanneer de beheerder een gebruiker wil bekijken.
 * 
 * @see Gebruiker
 */

function getAnswersForQuestion($myAnswers, $question){
    $arr = [];
    
    foreach($myAnswers as $mya){
        if($mya->wensVraagId == $question->id){
            array_push($arr, $mya);
        }
    }
    
    return $arr;
}

function getAntwoordVanResultaat($answerList, $resultaat){
    foreach($answerList as $al){
        if($al->id == $resultaat){
            return "<br>" . $al->antwoord;
        }
    }
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View User</h1>
        </div>
    </div>
    <div class="btn-toolbar pull-right" style="margin-bottom: 10px">
        <div class="btn-group">
            <a href="<?=site_url() ?>/gebruiker/edit/<?php echo $user->id; ?>" class="btn btn-default">Edit User</a>
        </div>
        <div class="btn-group">
            <a href="<?=site_url() ?>/gebruiker/remove/<?php echo $user->id; ?>" class="btn btn-danger">Delete User</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Title</b>
            <p><?php echo ($user->titel == "" ? "-" : $user->titel); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>First Name</b>
            <p><?php echo ($user->voornaam == "" ? "-" : $user->voornaam); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Last Name</b>
            <p><?php echo ($user->achternaam == "" ? "-" : $user->achternaam); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>E-mail</b>
            <p><?php echo ($user->email == "" ? "-" : $user->email); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Mobile</b>
            <p><?php echo ($user->mobiel == "" ? "-" : $user->mobiel); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Gender</b>
            <p><?php echo ($user->gender == 0 ? "Man" : "Woman"); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Account Type</b>
            <p><?php echo $user->type->naam; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Institution</b>
            <p><?php echo ($user->institutie == "" ? "-" : $user->institutie); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Country</b>
            <p><?php echo ($user->land == "" ? "-" : $user->land); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Position</b>
            <p><?php echo ($user->positie == "" ? "-" : $user->positie); ?></p>
        </div>
        <div class="col-lg-6">
            <b>Study Field</b>
            <p><?php echo ($user->studieGebied == "" ? "-" : $user->studieGebied); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Your biography</b>
            <p><?php echo ($user->biografie == "" ? "-" : $user->biografie); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <b>Name of Thomas More contact person</b>
            <p><?php echo ($user->tmContact == "" ? "-" : $user->tmContact); ?></p>
        </div>
    </div>
    <?php
    if(count($myAnswers) > 0){
        echo '
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Wishes</h2>
                </div>
            </div>
            ';
        
        foreach($wishQuestions as $wq){
            $answers = getAnswersForQuestion($myAnswers, $wq);
            $answersStr = "";
            
            if(isset($wq->answerList) && count($wq->answerList) > 0){
                foreach($answers as $wqa){
                    $answersStr .= getAntwoordVanResultaat($wq->answerList, $wqa->resultaat);
                }
            }else{
                foreach($answers as $wqa){
                    $answersStr .= "<br>" . $wqa->resultaat;
                }
            }
            
            if($answersStr == ""){
                $answersStr = "<br>/";
            }
            
            echo '
                <div class="row">
                    <div class="col-lg-12">
                        <b>' . $wq->naam . '</b>
                        <p>' . substr($answersStr, 4) . '</p>
                    </div>
                </div>
            ';
        }
    }
    
    if(count($lectures) > 0){
        $i = 0;
        
        echo '
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Lectures</h2>
                </div>
            </div>
            ';
        
        echo '<table width="100%" class="table table-bordered table-hover"><tr><th>Title</th><th>Field</th><th>Duration</th><th>Language</th></tr>';
        
        foreach($lectures as $l){
            $i++;
            
            $class = "custom-even";
            
            if($i % 2 != 0){
                $class = 'custom-odd';
            }
            
            echo '
                <tr class="' . $class . ' row1">
                    <td>' . $l->titel . '</td>
                    <td>' . $l->studieGebied . '</td>
                    <td>' . $l->duur . '</td>
                    <td>' . $l->taal->naam . '</td>
                </tr>
                <tr class="' . $class . ' row2">
                    <td colspan="4">' . $l->inhoud . '</td>
                </tr>
            ';
        }
        
        echo "</table>";
    }
    ?>
</div>