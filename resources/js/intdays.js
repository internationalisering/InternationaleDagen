var µ = {
    wensen_formulier: {
        newid: 1,
        toggleVisibility: function(icon){
            µ.wensen_formulier.setSaved(false);
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
            µ.wensen_formulier.setSaved(false);
            $(icon).parent().parent().remove();
            return false;
        },
        edit: function(icon){
            µ.wensen_formulier.setSaved(false);
            µ.wensen_formulier.modal.show(µ.wensen_formulier.getQuestion($(icon).parent().parent().attr("id")));
            return false;
        },
        add: function(){
            $(".wish-questions").append(`
                <li id="wq-n` + µ.wensen_formulier.newid + `" class="inactive">
                	<div class="icons">
                		<a href="#" onclick="return µ.wensen_formulier.toggleVisibility(this);"><i class="fas fa-eye"></i></a>
                		<a href="#" onclick="return µ.wensen_formulier.edit(this);"><i class="fas fa-pencil"></i></a>
                		<a href="#" onclick="return µ.wensen_formulier.delete(this);"><i class="fas fa-times"></i></a>
                	</div>
                	<span class="wq-type" hidden>3</span>
                	<b class="wq-question">New question</b><br>
                	<ul class="wq-options">
                	
                	</ul>
                </li>
            `);
            
            µ.wensen_formulier.newid++;
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
            return type == 1 || type == 2 || type == 5;
        },
        save: function(){
            var questions = [];
            var questionHTML = $(".wish-questions > li");
            
            for(var i = 0; i < questionHTML.length; i++){
                var q = µ.wensen_formulier.getQuestion(questionHTML[i].id);
                
                var options = [];
                var optionsHTML = q.options;
                
                for(var j = 0; j < optionsHTML.length; j++){
                    options.push($(optionsHTML[j]).html());
                }
                
                q.id = q.id.split("-")[1];
                q.options = options;
                q.active = !$(questionHTML[i]).hasClass("inactive");
                
                questions.push(q);
            }
            
            $.post(site_url() + "/wensen/beheeropslaan", {questions: questions}, function(result){
                µ.wensen_formulier.setSaved(true);
            });
            
            return false;
        },
        setSaved: function(bool){
            if(bool){
                $("#wensen_formulier_changes").css("color", "green").html("All changes are saved!");
            }else{
                $("#wensen_formulier_changes").css("color", "red").html("Unsaved changes!");
            }
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
                    
                    html += '<a href="#" onclick="return µ.wensen_formulier.modal.addOption(this);" id="wq-edit-option-add"><i class="fas fa-plus"></i></a>';
                    
                    html += "</div>";
                    
                    return html;
                }else{
                    return "";
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
    },
    search: function(){
        if($("#search-text").val() == ""){
            $("#results").html("");
        }else{
            $.get(site_url() + "/zoeken/zoek?text=" + encodeURI($("#search-text").val()) + "&previousEditions=" + $("#search-previouseditions").val(), function(data){
                $("#results").html(data);
            });
        }
        
        return false;
    }
};