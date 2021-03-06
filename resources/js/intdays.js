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
        sortableActive: null,
        currentEdit: null,      
        
        

        initialize: function(sortableActive)
        {
            µ.planning_edit.sortableActive = sortableActive;

            µ.planning_edit.updateSortable();
            µ.planning_edit.resizeItems();
            µ.planning_edit.checkExcessRows();
            µ.planning_edit.validateItems();
        },
        markAsDefinitive: function(bool=0)
        {
            $.ajax({
                url: site_url() + "/planning/markAsDefinitive/" + parseInt(bool), 
                success: function(result)
                {
                    $('#modal-content').html(result);
                    $('#modal').modal();
                }
            });
        },
        updateSortable: function()
        {

       
            $( ".planning-edit-sortable" ).sortable({
                connectWith: ".planning-edit-sortable",
                stop: µ.planning_edit.resizeItems
            }).disableSelection();

            if(! µ.planning_edit.sortableActive )
            {
                $( ".planning-edit-sortable" ).sortable("disable")
                $('#editing-finished').show();
            }
            
        },
        setTimepickers: function()
        {

            $('[name=from]').not('.hasTimepicker').timepicker().on('change', µ.planning_edit.validateHours);

            $('[name=til]').not('.hasTimepicker').timepicker().on('change', µ.planning_edit.validateHours);
        },
        updateChildren: function()
        {

            $('.planning-edit-child').each(function(index, child)
            {
                var child = $(child);
                var childWidth = parseInt(child.css('width'));

                if(!child.hasClass('planning-edit-child-break')) // ACTIVITY
                {
                    child.attr('title', child.data('title')); // tooltip

                    var title = child.attr('data-title') || '';
                    var author = child.attr('data-author') || '';
                    author += ': ';
                    var mandatoryClassesText = child.attr('data-mandatory-classes-text') || '';
                    var maxAmount = child.attr('data-max-amount') || '';
                    var aantalStudenten = child.attr('data-max-amount') || 'test';


                    child.html(  "<p class='planning-edit-session-title'>"+title+"</p>"
                                + "<p class='planning-edit-session-author'>"+author + mandatoryClassesText  + ". Studenten:  " + aantalStudenten +"</p>"
                                + "<span class='planning-edit-child-tick' data-column-id='3'>"
                                  + "<img class='img-16' src='"+base_url()+"/resources/images/tick.png'/>&nbsp;"
                                + "</span>   ");

                } else { // BREAK


                    child.attr('title', child.data('title')); // tooltip

                    var breakReason = child.attr('data-break') || 'Nog niet ingevuld';

                    child.html(  "<p class='planning-edit-session-title'>Break: "+breakReason+"</p>"
                                + "<p class='planning-edit-session-author'>&nbsp;</p>"
                                + "<span class='planning-edit-child-tick' data-column-id='3'>"
                                  + "<img class='img-16' src='"+base_url()+"/resources/images/tick.png'/>&nbsp;"
                                + "</span>   ");
                }      
                
                //child.find('.planning-edit-session-title').css('font-size', childWidth + 'px');
                //child.find('.planning-edit-session-title').css('font-size', '100%' );

            })
            µ.planning_edit.setClickableTicks();
            µ.planning_edit.validateItems();

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

            var isBreak = $(column).hasClass('planning-edit-child-break');
            var breakReason = "";
            if(isBreak)
                breakReason = ($(column).data('break') || '');
        
      

            $.ajax({
                url: site_url() + "/planning/editColumn/" + isBreak + "/" + breakReason, 
                success: function(result)
                {
                    $('#modal-content').html(result);
                    $('#modal').modal();

                    $('#search-button').click(µ.planning_edit.editSessionSearchSubmit);



                    var presentUsers = JSON.parse($(column).attr('data-presence'));

                    console.log(presentUsers);

                    $('#invigilators').html('');
                    $(presentUsers).each(function(i, user)
                    {                       
                        if(user.surveillant)
                            if(user.geselecteerd)
                                $('#invigilators').append('<p><input class="planning-input-checkbox" type="checkbox" id="'+user.gebruikerId+'" checked/> ' + user.naam  + '</p>');
                            else 
                                $('#invigilators').append('<p><input class="planning-input-checkbox" type="checkbox" id="'+user.gebruikerId+'" /> ' + user.naam  + '</p>');
                  });
                      

                    
                    // Kijken of currentEdit al een sessie-id heeft. Zo ja: info opzoeken, zo nee: zoekformulier toenen
                    var sessionId = µ.planning_edit.currentEdit.data('session-id');
                    if(sessionId)
                    {
                        $('#search-session').hide();
                        $('#session-settings').show();
                        µ.planning_edit.getSessionInfo(sessionId);
                    }

                    $('#max-amount').val(column.attr('data-max-amount'));

                    // instellen van mandatory classes
                    var mandatoryClasses = ($(column).attr('data-mandatory-classes'));

                    if(mandatoryClasses)
                    {
                        mandatoryClasses = mandatoryClasses.split('|');
                        $('#mandatory-classes').find('input[type=checkbox]').each(function(index, checkbox)
                        {
                            var checkbox = $(checkbox);


                            $(mandatoryClasses).each(function(i, classId)
                            {
                                if(checkbox.val() == classId)
                                    checkbox.attr('checked', '1');

                            });

                        });
                    }
                    if(isBreak)
                    {
                        $('.planning-edit-button-ok').show().click(µ.planning_edit.confirmSessionBreak);
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
        confirmSessionBreak: function()
        {
            $('#modal').modal('hide');
            µ.planning_edit.currentEdit.attr('data-break', $('#breakReason').val());
            µ.planning_edit.updateChildren();

        },
        confirmSession: function(session)
        {
            $('#modal').modal('hide');

            
            var mandatoryClassesId = [];
            var mandatoryClassesText = [];            

            $('#mandatory-classes input:checked').each(function(index, check)
            {
                var check = $(check);
                mandatoryClassesId.push( check.val() );
                mandatoryClassesText.push( check.data('class') );
            })

            var currentPresence = µ.planning_edit.currentEdit.attr('data-presence');
            if(currentPresence)
                currentPresence = JSON.parse(currentPresence);            
            else 
                currentPresence = [];



            $('#invigilators input[type=checkbox]').each(function(index, object)
            { 
                $(currentPresence).each(function(index, users)
                {

                    if(users.gebruikerId == $(object).attr('id'))
                    {
                        users.geselecteerd = ($(object).is(':checked')?1:0);
                    }
                });
            });

            currentPresence = JSON.stringify(currentPresence);

            console.log(currentPresence);
            µ.planning_edit.currentEdit.attr('data-max-amount', $('#max-amount').val());

            µ.planning_edit.currentEdit.attr('data-presence', currentPresence);

            µ.planning_edit.currentEdit.attr('data-session-id', session.id);
            µ.planning_edit.currentEdit.attr('data-title', session.titel);
            µ.planning_edit.currentEdit.attr('data-author', session.gebruiker.voornaam + ' ' + session.gebruiker.achternaam);
            
            µ.planning_edit.currentEdit.attr('data-mandatory-classes', mandatoryClassesId.join('|'));
            µ.planning_edit.currentEdit.attr('data-mandatory-classes-text', mandatoryClassesText.join(', '));
      
            µ.planning_edit.updateChildren();
        },
        getSessionInfo: function(sessionId)
        {
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
        calculateSecondsBetweenHours: function(hourFrom, hourTil)
        {
            var timeStart = new Date("01/01/2000 " + hourFrom).getTime();
            var timeEnd = new Date("01/01/2000 " + hourTil).getTime();

            return (timeEnd - timeStart)/1000;
        },
        showDate: function(date)
        {

            if(µ.planning_edit.sortableActive)
                µ.planning_edit.trySave(function(){ window.location.replace( site_url() + '/planning/edit/' + date); });
            else 
                window.location.replace( site_url() + '/planning/edit/' + date);
        },
        validateHours: function()
        {
            µ.planning_edit.updateRowIds();

            // huidige FROM vergelijken met huidige TIL
            $('.planning-edit-row-parent').each(function(index, row)
            {
                var row = $(row);



                var currentFrom = row.find('[name=from]');
                var currentTil  = row.find('[name=til]' );

                // check if visible

                if(currentFrom.parent().css('display') != 'none')
                {

                    var difference = µ.planning_edit.calculateSecondsBetweenHours(currentFrom.val(), currentTil.val());

                    currentTil.css('background-color', (difference<300 ? 'red': '' ) );
                }
            });


            // vorige TIL vergelijken met huidige FROM
            $('.planning-edit-row-parent[data-row-id!=0]').each(function(index, row)
            {
                var rowId = parseInt($(row).data('row-id'));

                var previousTil = $('.planning-edit-row-parent[data-row-id='+(rowId-1)+']').find('[name=til]').val();
                var currentFrom = $(row).find('[name=from]').val();

                var difference = µ.planning_edit.calculateSecondsBetweenHours(previousTil, currentFrom);

                $(row).find('[name=from]').css('background-color', (difference<0 ? 'red': '' ) ).attr('difference', difference);
                if(difference<0)
                {
                    console.log(difference, previousTil, currentFrom, rowId);
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
            $('.planning-edit-row-buttons').before("<div class='planning-edit-row-parent' data-row-id=''>"
                    + "<div class='planning-edit-info'>"
                        + "<input type='text' name='from' class='planning-edit-time'> - <input type='text' name='til' class='planning-edit-time'>"
                    + "</div>"
                + "<div  class='planning-edit-sortable planning-edit-sortable-row'></div></div>");       
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
            µ.planning_edit.setTimepickers();
            µ.planning_edit.toggleInfo(0, true);

        },
        toggleInfo: function(rowId, bool)
        {
            var info = $('div[data-row-id='+rowId+'] > .planning-edit-info');
            if(bool)
                info.show();
            else 
                info.hide();
        },
        addItem: function(rowId, isBreak)
        {
            if(isBreak)
                $('div[data-row-id='+rowId+'] > div.planning-edit-sortable').append('<div data-title="Nog geen pauze ingesteld" class="planning-edit-child planning-edit-child-break">Break</div>');
            else 
                $('div[data-row-id='+rowId+'] > div.planning-edit-sortable').append('<div data-title="Nog geen sessie ingesteld" class="planning-edit-child"></div>');
        },
        addAddButton: function()
        {
            if(µ.planning_edit.sortableActive)
            {
                $('.planning-edit-row-buttons').html('');
                $('.planning-edit-row-buttons').append("<div class='planning-edit-new-child planning-edit-add planning-edit-button'>Add Activity</div><div class='planning-edit-new-child planning-edit-child-break planning-edit-button'>Add Break</div><div class='planning-edit-remove-child planning-edit-button'>Remove</div>");
            }
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
            µ.planning_edit.validateItems();

            // Kijken of er nieuw item toegevoegd is
            $('.planning-edit-sortable-row div').each(function(index, child)
            {
                if($(child).hasClass('planning-edit-new-child'))
                {
                    var rowId = $(child).parent().parent().attr('data-row-id');

                    if(rowId != 'undefined')
                    {
                        µ.planning_edit.addItem(rowId, $(child).hasClass('planning-edit-child-break')); // Voeg element toe. Boolean = al dan niet break

                    }

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
                    var calculatedWidth = ( (row.parent().width()/2/childrenCount) - 6*childrenCount) ;

                    child = $(child);

                    if(child.hasClass('planning-edit-child'))
                    {
                        child.css('width', calculatedWidth )

                    }

                })
            });
            µ.planning_edit.updateChildren();

        },
        validateItems: function()
        {
            $('.planning-edit-child').each(function(index, child)
            {
                var child = $(child);

                if(child.hasClass('planning-edit-child-break'))
                {
             
                } else {
                    if(child.attr('data-session-id'))
                        child.css('background-color', '');
                    else 
                        child.css('background-color', 'darkblue');
                }

            })
        },
        toJson: function()
        {
            µ.planning_edit.validateItems();
                       
                        
            var planning = [];
            var rows = [];
            var date; 

            $('.planning-edit-row-parent').each(function(index, row) // Voor elke rij
            {   
                var row  = $(row);
                date = row.parent().data('date');
                var from = row.find('input[name=from]').val(); 
                var til  = row.find('input[name=til]').val(); 
                var children = [];

                var childrenCount = 0;

                row.find('.planning-edit-child').each(function(index2, child)
                {
                    var child = $(child);
                    var type = 'activity';
                    if(child.hasClass('planning-edit-child-break'))
                        type = 'break';


                    if(type == 'activity')
                    {
                        var sessionId = child.attr('data-session-id');
                        var maxHoeveelheid = child.attr('data-max-amount');


                        var allowedClasses = child.attr('data-mandatory-classes');

                        if(allowedClasses)
                            allowedClasses = allowedClasses.split('|');
                        else
                            allowedClasses = [];

                        var aanwezigheden = [];
                        if(child.attr('data-presence'))
                            aanwezigheden = JSON.parse(child.attr('data-presence'));   
                         


                        children.push({
                            type: type,
                            maxHoeveelheid: maxHoeveelheid,
                            aanwezigheden: aanwezigheden,
                            sessionId: child.attr('data-session-id'),
                            allowedClasses: allowedClasses
                        })


                    } else {

                        var breakReason = child.data('break');

                        if(breakReason)
                            child.css('background-color', '');
                        else 
                            child.css('background-color', '#D15700');


                        children.push({
                            type: type,
                            break: (breakReason || ''),
                        })
                    }

                    childrenCount++;
                })



                if(childrenCount)
                {
                    rows.push({
                        'from': from,
                        'til': til,
                        'columns': children
                    });
                }

                

            })
            planning.push(
            {
                'date': date,
                'rows': rows

            });

            return planning[0];

        },
        trySave: function(callback = null)
        {
            var planning = JSON.stringify(µ.planning_edit.toJson());
            console.log(planning);

            $.ajax({
              type: "POST",
              url: site_url()+'/planning/editSave',
              data: {planning: planning},
              success: function(result){ 

                    $('#modal-content').html('<div style="padding: 15px;"><p>Succesvol opgeslagen!</p></div>');
                    console.log(result);
                    $('#modal').modal();
                    if(callback)
                    {
                        callback();
                    }
              },

               error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status, xhr.responseText);
                console.log(thrownError);
              }
            });

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