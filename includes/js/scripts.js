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

    //Save question
    $(document).on('click','#save-question-btn',function(){
        var option1 = $('#question input[data-name="option1"]').val();
        var option2 = $('#question input[data-name=option2]').val();
        var option3 = $('#question input[data-name=option3]').val();
        var correct_option = $('#question input[data-name=correct]').val();
        var question = $('#question input[data-name="question"]').val();
        var subject = $('#question-subject-select option:selected').text();
        var topic = $('#question-topic-select option:selected').text();

        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "html",
            data: {
                action: "save_question",
                option1:option1,
                option2:option2,
                option3:option3,
                correct_option:correct_option,
                question:question,
                subject:subject,
                topic:topic
            },
            success: function(response) {
                alert(response);

                $('#question input[data-name="option1"]').val('');
                $('#question input[data-name=option2]').val('');
                $('#question input[data-name=option3]').val('');
                $('#question input[data-name=correct]').val('');
                $('#question input[data-name="question"]').val('');
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });
    });

    //Generate test with closed questions
    $(document).on('click','#generate-closed',function(){   
        var topicsArray = [];
        $('#generate input:checked').each(function(){
            var thisTopic = $(this).siblings('label').text();
            var thisSubject = $(this).parents('.form-check').siblings('h4').text();
            var topicName = thisSubject+'/'+thisTopic;
            topicsArray.push(topicName);
        });
        console.log(topicsArray);

        $.ajax({
            type:"POST",
            url:"ajax.php",
            dataType:"html",
            data:{
                action:"generate_test",
                type:"closed",
                topicsArray:topicsArray
            },
            success:function(){
                window.location = 'generate_test.php';
            },
            error: function(xhr, status, error) {
                console.error("AJAX Request Error:", status, error);
            }
        });
    });

    //Check if answer is correct
    $(document).on('click','button.option',function(){
        if($(this).hasClass('correct')){
            $(this).removeClass('btn-outline-dark');
            $(this).addClass('btn-success');
            $currentAnswers = $('#answers').text();
            
            $('#answers').text(++$currentAnswers);
        }else{
            $(this).removeClass('btn-outline-dark');
            $(this).addClass('btn-danger');
        }
        $(this).siblings('button').addClass('disabled');
    });
    
}); 