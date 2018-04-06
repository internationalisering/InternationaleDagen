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
                options: $("#" + wq_id + " .wq-options li")
            };
        },
        typeHasOptions: function(type){
            return type == 1 || type == 2;
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
                        <div class="form-group">
                            <label for="wq-edit-question">Question:</label>
                            <input id="wq-edit-question" type="text" value="` + wq.question + `" />
                        </div>
                        ` + µ.wensen_formulier.modal.buildType(wq) + `
                        ` + µ.wensen_formulier.modal.buildOptions(wq) + `
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="µ.wensen_formulier.modal.save();">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                `);
                $('#modal').modal();
            },
            buildType: function(wq){
                var types = $("#wishTypes li")
                
                var html = "<div class='form-group'><label for='wq-edit-type'>Type:</label><select id='wq-edit-type' onchange='µ.wensen_formulier.modal.changeType();'>";
                
                for(var i = 0; i < types.length; i++){
                    var t = $(types[i]);
                    var id = t.attr('data-id');
                    
                    if(wq.type == id){
                        html += "<option value='" + id + "' selected='selected'>" + t.html() + "</option>";
                    }else{
                        html += "<option value='" + id + "'>" + t.html() + "</option>";
                    }
                }
                
                html += "</select></div>";
                
                return html;
            },
            buildOptions: function(wq){
                if(wq == undefined){
                    return '<div class="form-group" id="wq-edit-options"><label>Options:</label><a href="#" onclick="return µ.wensen_formulier.modal.addOption(this);" id="wq-edit-option-add"><i class="fas fa-plus"></i></a></div>';
                }else if(µ.wensen_formulier.typeHasOptions(wq.type)){
                    var html = "<div class='form-group' id='wq-edit-options'><label>Options:</label>";
                    
                    for(var i = 0; i < wq.options.length; i++){
                        var o = $(wq.options[i]);
                        
                        html += '<input class="wq-edit-option" type="text" value="' + $(o).html() + '" /><a href="#" onclick="return µ.wensen_formulier.modal.removeOption(this);" class="wq-edit-option-delete"><i class="fas fa-times"></i></a>';
                    }
                    
<<<<<<< HEAD
                    html += '<a href="#" onclick="return µ.wensen_formulier.modal.addOption(this);" id="wq-edit-option-add"><i class="fas fa-plus"></i></a>';
                    
                    html += "</div>";
                    
                    return html;
                }else{
                    return "";
=======
                    html += '<input id="wq-edit-question" type="text" value="` + wq.question + `" />';
>>>>>>> parent of 103af1e... Een hele hoop kleine aanpassingen
                }
            },
            removeOption: function(link){
                var a = $(link);
                a.prev().remove();
                a.remove();
                
                return false;
            },
            addOption: function(link){
                var a = $(link);
                
                a.before('<input class="wq-edit-option" type="text" value="" /><a href="#" onclick="return µ.wensen_formulier.modal.removeOption(this);" class="wq-edit-option-delete"><i class="fas fa-times"></i></a>');
                
                return false;
            },
            changeType: function(){
                var val = $("#wq-edit-type").val();
                var options = $("#wq-edit-options");
                
                if(µ.wensen_formulier.typeHasOptions(val) && options.length == 0){
                    $(".modal-body").append(µ.wensen_formulier.modal.buildOptions(undefined));
                }else if(!µ.wensen_formulier.typeHasOptions(val) && options.length == 1){
                    options.remove();
                }
            },
            save: function(){
                var id = $("#wq-edit-id").val();
                
                $("#" + id + " .wq-question").html($("#wq-edit-question").val());
                $("#" + id + " .wq-type").html($("#wq-edit-type").val());
                
                var options = $("#wq-edit-options .wq-edit-option");
                var html = "";
                
                for(var i = 0; i < options.length; i++){
                    html += '<li>' + $(options[i]).val() + '</li>';
                }
                
                $("#" + id + " .wq-options").html(html);
            }
        }
    }
};