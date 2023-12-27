$(document).ready(function(){
    //Save settings
    $(document).on('click','#save-settings',function(){
        var settingsObject = {};

        $('.settings-input').each(function(){
            var key = $(this).attr('data-key');
            var name = $(this).attr('data-name');
            var value = $(this).val();
            
            settingsObject[key] = {};
            Object.assign(settingsObject[key], { ['name']:name });
            Object.assign(settingsObject[key], { ['value']:value });
            
        });

        settingsJson = JSON.stringify(settingsObject);

        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {
                action: "save_settings",
                settings: settingsJson
            },
            success: function() {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });

    })

    //Add subject
    
    $(document).on('click','#subject button',function(){
        var subject = $('#subject input').val();
        console.log(subject);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {
                action: "save_subject",
                subject: subject
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });

    })

    //Add topic

    $(document).on('click','#topic button',function(){
        var topic = $('#topic input').val();
        var subject = $('#subject-select option:selected').text();
        console.log(subject,topic);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {
                action: "save_topic",
                topic:topic,
                subject: subject
            },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });
    })

    //Question topic select population

    $('#question-subject-select').change(function(){
        var selected_subject = $(this).find('option:selected').text();
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {
                action: "selected_subject",
                selected_subject:selected_subject
            },
            success: function(response) {
                var topics = JSON.parse(response);
                var select = $("#question-topic-select");
                select.find('option').remove();
                $.each(topics, function() {
                    select.append($("<option />").val(this).text(this));
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });
    });
}); 