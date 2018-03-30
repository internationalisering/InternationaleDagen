var µ = {
    wensen_formulier: {
        toggleVisibility: function(icon){
            var a = $(icon);
            var li = a.parent().parent();
            
            if(li.hasClass("inactive")){
                li.removeClass("inactive");
                a.find("svg").removeClass("fa-eye").addClass("fa-eye-slash");
            }else{
                li.addClass("inactive");
                a.find("svg").removeClass("fa-eye-slash").addClass("fa-eye");
            }
            
            return false;
        },
        delete: function(icon){
            $(icon).parent().parent().remove();
            return false;
        },
        edit: function(icon){
            µ.wensen_formulier.modal.show(µ.wensen_formulier.getQuestion($(icon).parent().parent().attr("id")));
            return false;
        },
        getQuestion: function(wq_id){
            return {
                id: wq_id,
                question: $("#" + wq_id + " .wq-question").html(),
                type: $("#" + wq_id + " .wq-type").html(),
                options: $("#" + wq_id + " .wq-options").html()
            };
        },
        modal: {
            show: function(wq){
                $('#modal-content').html(`
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Question</h4>
                    </div>
                    <div class="modal-body">
                        <input id="wq-edit-id" type="text" value="` + wq.id + `" hidden />
                        <input id="wq-edit-question" type="text" value="` + wq.question + `" />
                        ` + µ.wensen_formulier.modal.buildType(wq.type) + `
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="µ.wensen_formulier.modal.save();">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                `);
                $('#modal').modal();
            },
            buildType: function(type){
                var types = $("#wishTypes li")
                
                var html = "<select id='wq-edit-type'>";
                
                for(var i = 0; i < types.length; i++){
                    var t = $(types[i]);
                    var id = t.attr('data-id');
                    
                    if(type == id){
                        html += "<option value='" + id + "' selected='selected'>" + t.html() + "</option>";
                    }else{
                        html += "<option value='" + id + "'>" + t.html() + "</option>";
                    }
                }
                
                html += "</select>";
                
                return html;
            },
            save: function(){
                var id = $("#wq-edit-id").val();
                
                $("#" + id + " .wq-question").html($("#wq-edit-question").val())
                $("#" + id + " .wq-type").html($("#wq-edit-type").val())
            }
        }
    }
};