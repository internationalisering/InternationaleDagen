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
    
    echo '<span class="wq-type" hidden>' . $q->formulierTypeId . '</span>';
    echo '<b class="wq-question">' . $q->naam . '</b><br>';
    
    echo '<ul class="wq-options">';
    foreach($q->answerList as $al){
        echo "<li>$al->antwoord</li>";
    }
    echo '</ul>';
    
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
            <div class="new-question" onclick="µ.wensen_formulier.add();">
                <div><i class="fas fa-plus fa-2x"></i></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="btn-group">
                <a href="#" class="btn btn-primary" onclick="return µ.wensen_formulier.save();">Save</a>
            </div>
            <span id="wensen_formulier_changes" style="color: gray;">No changes made!</span>
        </div>
    </div>
</div>
<script>
$(function(){
    $(".wish-questions").sortable();
    $(".wish-questions").disableSelection();
});
</script>