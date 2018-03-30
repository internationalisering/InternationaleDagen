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
                    echo '
                        <li' . ($q->actief ? "" : " class='inactive'") . '>
                            <b>' . $q->naam . '</b><br>
                            ';
                            
                            foreach($q->answerList as $al){
                                echo $al->antwoord . '<br>';
                            }
                            
                            echo '
                        </li>
                    ';
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