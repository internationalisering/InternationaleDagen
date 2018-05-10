<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $column->sessie->titel; ?></h4>
</div>
<div class="modal-body">
  <p><?= $column->sessie->inhoud ?></p>

  <div class="planning-feedback">
    <p><strong>Feedback:</strong></p>
    <p>
      <textarea rows=5 cols=50 placeholder="Feedback will be reviewed" name="feedback" id="feedback"><?= isset($feedback->inhoud) ? $feedback->inhoud : '' ?></textarea>
    </p>
    <button class="btn btn-primary" onclick="µ.planning_view.feedbackSubmit(<?= $column->sessie->id; ?>)">Submit</button>

  </div>
</div>
<div class="modal-footer">
    <span><?= $aantalIngeschreven ?>/<?= $column->maxHoeveelheid ?>&nbsp;</span>
    <button 
        type="button"
        onclick='µ.planning_view.feedback(<?= $column->id ?>)'
        class="btn btn-info">Feedback
      </button>

    <?php if($ingeschreven){?>
      <button 
        type="button" 
        onclick='µ.planning_view.withdraw(<?= $column->id ?>); $(this).addClass("disabled");'
        class="btn btn-danger" 
       >Withdraw
      </button>

    <?php } else { ?>

      <button 
        type="button" 
        onclick='µ.planning_view.enroll(<?= $column->id ?>); $(this).addClass("disabled");' 
        class="btn btn-warning"  
       >Enroll
      </button>

    <?php } ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
