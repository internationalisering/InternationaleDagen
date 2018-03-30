<?php
function createQuestionLi($q){
    if($q->actief){
        echo '<li id="wq-' . $q->id . '">';
    }else{
        echo '<li id="wq-' . $q->id . '" class="inactive">';
    }
    
    echo '
        <div class="icons">
            <a href="#" onclick="return µ.wensen_formulier.toggleVisibility(this);"><i class="fas ' . ($q->actief ? "fa-eye-slash" : "fa-eye") . '"></i></a>
            <a href="#" onclick="return µ.wensen_formulier.edit(this);"><i class="fas fa-pencil"></i></a>
            <a href="#" onclick="return µ.wensen_formulier.delete(this);"><i class="fas fa-times"></i></a>
        </div>
    ';
    
    echo '<span class="wq-type" hidden>' . $q->formTypeId . '</span>';
    echo '<b class="wq-question">' . $q->naam . '</b><br>';
    
    foreach($q->answerList as $al){
        echo $al->antwoord . '<br>';
    }
    
    echo '</li>';
}
?>
<ul id="wishTypes" hidden>
    <?php
    foreach ($wishTypes as $t){
        echo '<li data-id="' . $t->id . '">' . $t->naam . '</li>';
    }
    ?>
</ul>
<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Wishes</h1>
        </div>
    </div>
    <?php $this->notifications->buildNotification(); ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="wish-questions">
                <?php
                foreach ($wishQuestions as $q){
                    createQuestionLi($q);
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<script>
$(function(){
    $(".wish-questions").sortable();
    $(".wish-questions").disableSelection();
});
</script>