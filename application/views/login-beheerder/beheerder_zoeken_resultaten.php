<?php
function calculateAllTotal($models){
    $i = 0;
    
    foreach($models as $model){
        $i += calculateTotal($model);
    }
    
    return $i;
}

function calculateTotal($model){
    return count($model['results']);
}

function hasResults($model){
    return count($model['results']) > 0;
}
?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu-all">All (<?= calculateAllTotal($models) ?>)</a></li>
    
    <?php
    foreach($models as $model){
        if(hasResults($model)){
            echo '<li><a data-toggle="tab" href="#menu-' . $model['modelName'] . '">' . $model['name'] . ' (' . calculateTotal($model) . ')</a></li>';
        }
    }
    ?>
</ul>

<div class="tab-content" style="padding-top: 15px;">
    <div id="menu-all" class="tab-pane fade in active">
        <?php
        foreach($models as $model){
            if(hasResults($model)){
                foreach($model['results'] as $result){
                    $text = $model['text'];
                    
                    $text = str_replace("{modelName}", $model['name'], $text);
                    $text = str_replace("{url}", str_replace("{id}", $result->id, $model['url']), $text);
                    
                    foreach($result as $key => $value){
                        $text = str_replace("{" . $key . "}", $value, $text);
                    }
                    
                    echo $text;
                }
            }
        }
        ?>
    </div>
    
    <?php
    foreach($models as $model){
        if(hasResults($model)){
            echo '<div id="menu-' . $model['modelName'] . '" class="tab-pane fade">';
            
            foreach($model['results'] as $result){
                $text = $model['text'];
                
                $text = str_replace("{modelName}", $model['name'], $text);
                $text = str_replace("{url}", str_replace("{id}", $result->id, $model['url']), $text);
                
                foreach($result as $key => $value){
                    $text = str_replace("{" . $key . "}", $value, $text);
                }
                
                echo $text;
            }
            
            echo '</div>';
        }
    }
    ?>
</div>