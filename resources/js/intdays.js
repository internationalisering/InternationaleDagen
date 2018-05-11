var µ = {
    planning_view:
    {
        initialize: function()
        {
            $('.planning-child-tick').click(function(obj)
            {
                var columnId = $(this).data('column-id');
                µ.planning_view.viewColumn(columnId);
            })

            µ.planning_view.addAddButton();
        },

        viewColumn: function(columnId)
        {
            $.ajax({
                url: site_url() + "/planning/viewColumn/" + columnId, 
                success: function(result)
                {
                    $('#modal-content').html(result);
                    $('#modal').modal();
                }
            });
        },
        showHelp: function()
        {
            $.ajax({
                url: site_url() + "/planning/help/", 
                success: function(result){
                $('#modal-content').html(result);
                $('#modal').modal();

            }});
        },

        btnEnrolledStudents: function()
        {
            $('#enrolledStudents').slideToggle();

        },
        enroll: function(columnId)
        {
             $.ajax({
                url: site_url() + "/planning/enroll/" + columnId, 
                success: function(result){
                    µ.planning_view.viewColumn(columnId);
                    µ.planning_view.setEnrolled(columnId, true);

            }});  
        },
        withdraw: function(columnId)
        {
             $.ajax({
                url: site_url() + "/planning/withdraw/" + columnId, 
                success: function(result){
                    µ.planning_view.viewColumn(columnId);
                    µ.planning_view.setEnrolled(columnId, false);

            }});  
        },
        setEnrolled: function(columnId, bool)
        {
            $('.planning-child-activity').each(function(index, object)
            {
                var _columnId = $(object).data('column-id');
                if(columnId == _columnId )
                {
                    if(bool)
                    {
                        $(object).addClass('planning-child-activity-enrolled');
                        $(object).removeClass('planning-child-activity-not-enrolled');
                    }
                    else 
                    {   
                        $(object).addClass('planning-child-activity-not-enrolled');
                        $(object).removeClass('planning-child-activity-enrolled');
                    }
                }
                
            });
        },
        feedback: function()
        {
            $('.planning-feedback').slideDown();

        },
        feedbackSubmit: function(sessionId)
        {
            $.ajax({
                url: site_url() + "/planning/feedback/" + sessionId, 
                data: {feedback: $('#feedback').val()},
                type: "POST",

                success: function(result)
                {
                    $('.planning-feedback').slideUp();
                }
            }); 
        }
    },
    planning_edit: 
    {
        currentEdit: null,  

        initialize: function()
        {
            µ.planning_edit.updateSortable();
            µ.planning_edit.resizeItems();
        },
        updateSortable: function()
        {
            $( ".planning-edit-sortable" ).sortable({
                connectWith: ".planning-edit-sortable",
                stop: µ.planning_edit.resizeItems
            }).disableSelection();
        },
        updateChildren: function()
        {
            $('.planning-edit-child').each(function(index, child)
            {
                var child = $(child);
                child.attr('title', child.data('title')); // tooltip
                child.html( child.data('title') + '<div class="planning-edit-child-tick">v</div>' );

            })
            µ.planning_edit.setClickableTicks();
        },
        setClickableTicks: function()
        {
            $('.planning-edit-child-tick').each(function(ind, tick)
            {
                $(tick).click(µ.planning_edit.onTickClick);
            });
        },

        onTickClick: function()
        {
            var tick = $(this);
            var column = tick.parent();

            µ.planning_edit.editSessionModal(column);
        },

        editSessionModal: function(column)
        {
            µ.planning_edit.currentEdit = column;

            $.ajax({
                url: site_url() + "/planning/editColumn/", 
                success: function(result)
                {
                    $('#modal-content').html(result);
                    $('#modal').modal();

                    $('#search-button').click(µ.planning_edit.editSessionSearchSubmit);

                    // Kijken of currentEdit al een sessie-id heeft. Zo ja: info opzoeken, zo nee: zoekformulier toenen
                    var sessionId = µ.planning_edit.currentEdit.data('session-id');
                    if(sessionId)
                    {
                        $('#search-session').hide();
                        $('#session-settings').show();
                        µ.planning_edit.getSessionInfo(sessionId);
                    }

                }
            });
        },

        editSessionSearchSubmit: function()
        {
            keyword = $('#search-input').val();
            $.ajax({
                url: site_url() + "/planning/search/"+keyword, 
                success: function(result)
                {
                    var currentSearch = jQuery.parseJSON(result);
                    $('#search-result').find("tr:gt(0)").remove();

                    $(currentSearch).each(function(index, object)
                    {
                        $('#search-result > tbody:last-child').append('<tr>' 
                                                                        + '<td>' + object.gebruiker.voornaam + ' ' + object.gebruiker.achternaam +'</td>'
                                                                        + '<td>' + object.titel + '</td>'   
                                                                        + '<td>' + object.duur + ' minuten</td>'
                                                                        + '<td> <a href="#" class="select-session" data-session-id="'+object.id+'">selecteer</a></td>' + 
                                                                    + '</tr>');
                    });


                    // Alle knoppen werkend maken 
                    $('.select-session').each(function(index, object)
                    {
                        $(object).click( µ.planning_edit.editSessionSelectSession );
                    });
                }
            });
        },
        confirmSession: function(session)
        {
            // Geeft array van alle checked checkboxes
            var mandatoryClasses = $('#mandatory-classes input:checked').map(function(){
              return $(this).val();
            }).get();



            $('#modal').modal('hide');
            µ.planning_edit.currentEdit.data('title', session.titel);
            µ.planning_edit.currentEdit.attr('data-mandatory-classes', mandatoryClasses.join('|'));
            µ.planning_edit.updateChildren();
        },
        getSessionInfo: function(sessionId)
        {
            console.log(sessionId);
            $.ajax({
                url: site_url() + "/planning/getSessionInfo/" + sessionId, 
                success: function(result)
                {
                    var object = jQuery.parseJSON(result);

                    $('.planning-edit-button-back').click(function(){
                        $('.planning-edit-button-back').hide();
                        $('#session-settings').hide();
                        $('#search-session').slideDown();
                    });
                    $('.planning-edit-button-ok').click(function()
                    {
                        µ.planning_edit.confirmSession(object);
                    });

                    $('#session-title'   ).html(object.titel);
                    $('#session-language').html(object.taal.naam);
                    $('#session-field'   ).html(object.studieGebied)
                    $('#session-length'  ).html(object.duur + ' minutes');
                    $('#session-summary' ).html(object.inhoud);

                    // Buttons
                    $('.planning-edit-button-close').hide();
                    $('.planning-edit-button-ok').show();

                }   
            });
        },

        editSessionSelectSession: function()
        {
            var sessionId = $(this).data('session-id');

            if(µ.planning_edit.currentEdit != null)
            {
                $('#session-settings').slideDown(); 
                $('#search-session').slideUp();
                µ.planning_edit.getSessionInfo(sessionId);
            }
        },

        addRow: function()
        {
            $('.planning-edit-row-buttons').before("<div class='planning-edit-row-parent' data-row-id=''><div class='planning-edit-info'><input type='text' class='planning-edit-time'>:<input type='text' class='planning-edit-time'></div><div  class='planning-edit-sortable planning-edit-sortable-row'></div></div>");       
            µ.planning_edit.updateRowIds();
        },
        updateRowIds: function()
        {
            $('.planning-edit-row-parent').each(function(index, object)
            {
                $(object).attr('data-row-id', index);
            });
        },
        checkExcessRows: function()
        {
           // Voeg rij toe indien nodig
            $('.planning-edit-row-parent').last().each(function(index, row)
            {   
                var rowId = $(row).data('row-id');
                var childrenCount = µ.planning_edit.getRowChildCount( $(row).find('.planning-edit-sortable') );
                
                if(childrenCount > 0) // Rij toevoegen
                {
                    µ.planning_edit.addRow();
                    µ.planning_edit.updateSortable();
                }
            }); 

            // Verwijder overbodige rijen 
            var eersteElement = true;
            $('.planning-edit-row-parent').each(function(index, row)
            {
                var rowId = $(row).data('row-id');
                var childrenCount = µ.planning_edit.getRowChildCount( $(row).find('.planning-edit-sortable') );
                    
                if(childrenCount == 0)
                {   
                    if(eersteElement)
                        eersteElement = false;
                    else 
                        $(row).remove();
                }

            });

            // Toon uren van volgende rij al
            $('.planning-edit-row-parent').each(function(index, row)
            {
                var rowId = $(row).data('row-id');
                µ.planning_edit.toggleInfo( rowId, µ.planning_edit.getRowChildCount( $(row).find('.planning-edit-sortable') ) );
            });
        },
        toggleInfo: function(rowId, bool)
        {
            var info = $('div[data-row-id='+rowId+'] > .planning-edit-info');
            if(bool)
                info.show();
            else 
                info.hide();
        },
        addItem: function(rowId)
        {
            $('div[data-row-id='+rowId+'] > div.planning-edit-sortable').append('<div class="planning-edit-child">test</div>');
        },
        addAddButton: function()
        {
            $('.planning-edit-row-buttons').html('');
            $('.planning-edit-row-buttons').append("<div class='planning-edit-new-child planning-edit-add planning-edit-button'>Add Activity</div><div class='planning-edit-new-child planning-edit-break planning-edit-button'>Add Break</div><div class='planning-edit-remove-child planning-edit-button'>Remove</div>");
            µ.planning_edit.updateSortable();
        },
        getRowChildCount: function(row)
        {
            var count = 0;
            row.children().each(function(index, object)
            {
                object = $(object);
                if(object.hasClass('planning-edit-child'))
                    count++;
            });

            return count;
        },
        removeButtons: function()
        {
            $('.planning-edit-row-buttons > div').each(function(index, child)
            {
                child = $(child);

                //if(child.data(''))
            });
        },
        
        resizeItems: function()
        {
            // Kijken of er nieuw item toegevoegd is
            $('.planning-edit-sortable-row div').each(function(index, child)
            {
                if($(child).hasClass('planning-edit-new-child'))
                {
                    var rowId = $(child).parent().parent().data('row-id');
                    if(rowId != 'undefined')
                        µ.planning_edit.addItem(rowId);

                    µ.planning_edit.addAddButton();
                    $(child).remove();
                }
                else if($(child).hasClass('planning-edit-remove-child'))
                {
                    $(child).remove();
                }
            });
            // Check if rows need to be added / hidden
            µ.planning_edit.checkExcessRows();



            // Set widths of all elements
            $('.planning-edit-sortable').each(function(index, row)
            {

                row = $(row);


                var childrenCount = µ.planning_edit.getRowChildCount(row);
                
                row.children().each(function(i, child)
                {
                    var calculatedWidth = (500/childrenCount)-((childrenCount-1)*6);

                    child = $(child);

                    if(child.hasClass('planning-edit-child'))
                        child.css('width', calculatedWidth )

                })
            });
            µ.planning_edit.updateChildren();

        }

    },
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