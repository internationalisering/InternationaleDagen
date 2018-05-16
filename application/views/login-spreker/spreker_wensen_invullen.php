<?php
/**
 * @file spreker_wensen_invullen.php
 * @author Brend Simons
 * 
 * Pagina die te zien is wanneer de spreker wensen wil invullen.
 * 
 * @see Wensen
 */
 
function buildOptions($q, $str, $answers){
    $i = 0;
    $str = str_replace("{qid}", $q->id, $str);
    
    if(isset($q->answerList) && count($q->answerList) > 0){
        foreach($q->answerList as $a){
            $s = $str;
            
            $s = str_replace("{aid}", $a->id, $s);
            $s = str_replace("{antwoord}", $a->antwoord, $s);
            $s = str_replace("{i}", $i++, $s);
            
            if(hasAnswerValue($answers, $a->id)){
                $s = str_replace("{checked}", " checked", $s);
                $s = str_replace("{selected}", " selected='selected'", $s);
            }else{
                $s = str_replace("{checked}", "", $s);
                $s = str_replace("{selected}", "", $s);
            }
            
            echo $s;
        }
    }else{
        if(count($answers) > 0){
            $str = str_replace("{value}", $answers[0]->resultaat, $str);
        }else{
            $str = str_replace("{value}", "", $str);
        }
        
        echo $str;
    }
}

function getAnswersForQuestion($myAnswers, $question){
    $arr = [];
    
    foreach($myAnswers as $mya){
        if($mya->wensVraagId == $question->id){
            array_push($arr, $mya);
        }
    }
    
    return $arr;
}

function hasAnswerValue($answers, $answer){
    foreach($answers as $a){
        if($a->resultaat == $answer){
            return true;
        }
    }
    
    return false;
}
?>
<div id="page-wrapper" class="page-wrapper-fullpage" style="padding-top: 15px !important;">
    <?php $this->notifications->buildNotification(); ?>
    <form action="<?= site_url() ?>/wensen/invullen" method="POST">
        <?php
        foreach ($wishQuestions as $q){
            echo '
                <div class="row">
                    <div class="form-group">
                        <label>' . $q->naam .  '</label>
                        <div class="clearfix"></div>
                        ';
                        
                        if($q->formulierTypeId == 1){
                            buildOptions($q, '<input type="radio" name="qa-{qid}" value="{aid}"{checked}> {antwoord}<br>', getAnswersForQuestion($myAnswers, $q));
                        }else if($q->formulierTypeId == 2){
                            buildOptions($q, '<input type="checkbox" name="qa-{qid}-{i}" value="{aid}"{checked}> {antwoord}<br>', getAnswersForQuestion($myAnswers, $q));
                        }else if($q->formulierTypeId == 3){
                            buildOptions($q, '<input class="form-control" name="qa-{qid}" value="{value}" />', getAnswersForQuestion($myAnswers, $q));
                        }else if($q->formulierTypeId == 4){
                            buildOptions($q, '<textarea name="qa-{qid}" style="width: 100%" rows="5">{value}</textarea>', getAnswersForQuestion($myAnswers, $q));
                        }else if($q->formulierTypeId == 5){
                            echo '<select name="qa-' . $q->id . '">';
                            buildOptions($q, '<option value="{aid}"{selected}>{antwoord}</option>', getAnswersForQuestion($myAnswers, $q));
                            echo '</select>';
                        }
                        
                        echo '
                    </div>
                </div>
            ';
        }
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                </div>
                <div class="btn-group">
                    <a href="<?=site_url() ?>/home" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>