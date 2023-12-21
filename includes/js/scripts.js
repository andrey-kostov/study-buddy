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
        console.log(typeof settingsObject);
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
});