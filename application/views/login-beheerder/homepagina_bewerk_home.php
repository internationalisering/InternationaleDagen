<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="bewerk">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav">Druk op de rode submitknop als je klaar bent met werken</h3>
            <button type="button" class="btn btn-danger" id="save">Submit</button>

        </div>
    </div>
    
    </div>
    <div class="row intro text">
        <div class="col-lg-12 col-md-12" contenteditable="true" id="webInhoud">
            <?php
            
            if($edition != null){
                echo nl2br($edition->homepagina);
            }else{
                echo "There's currently no edition going on!";
            }

            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
            $(document).ready(function(argument) {
                $('#save').click(function(){
                    var edit = $('#webInhoud').html();
                    $.ajax({
                        url: site_url() + '/home/homepagina_update',
                        type: 'post',
                        data: {homepagina: edit},
                        datatype: 'html',
                        success: function(rsp){
                                alert(rsp);
                            }
                    });
                });

            });
</script>

<style>
.bewerk {
    padding: 3%;
    background-color: #f9f9f9;
}

a {
    padding: -3%;
    text-align: center;
}

.text {
    margin-top: 10px;
}


</style>