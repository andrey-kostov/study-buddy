<?php 
    $settingsJson = file_get_contents('includes/settings.json');
    $settings = json_decode($settingsJson);

    $translationsJson = file_get_contents('includes/translations.json');
    $translations = json_decode($translationsJson);
    // var_dump($translations);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $settings->projectName->value; ?></title>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Include Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Include custom stylesheet -->
    <link rel="stylesheet" href="includes/css/stylesheet.css">
    <!-- Include custom scripts -->
    <script src="includes/js/scripts.js"></script>
</head>
<body>
    <!-- Navigation Start -->
    <nav class="navbar sticky-top bg-body-tertiary">
        <div class="container-fluid d-flex justify-content-center">
            <a class="nav-link mx-3" href="#generate"><?php echo $translations->generate;?></a>
            <a class="nav-link mx-3" href="#subject"><?php echo $translations->subject;?></a>
            <a class="nav-link mx-3" href="#topic"><?php echo $translations->topic;?></a>
            <a class="nav-link mx-3" href="#question"><?php echo $translations->question;?></a>
            <a class="nav-link mx-3" href="#settings"><?php echo $translations->settings;?></a>
            <a class="nav-link mx-3" href="#about"><?php echo $translations->about;?></a>
        </div>
    </nav>
    <!-- Navigation End -->

    <div class="container-fluid p-3">
        <div id="content-wrapper" >
            <h1><?php echo $settings->projectName->value;?></h1>

            <!-- Generate test Start -->
                <div class="container-fluid d-flex justify-content-center mt-4 p-3" id="generate">
                    <h2 class="text-center">
                        <?php echo $translations->generate;?>
                    </h2>
                    
                </div>
            <!-- Generate test End -->


            <!-- Add subject Start -->
                <div class="container-fluid d-flex justify-content-center mt-4 p-3" id="subject">
                    <h2 class="text-center">
                        <?php echo $translations->subject;?>
                    </h2>
                    
                </div>
            <!-- Add subject End -->


            <!-- Add topic Start -->
                <div class="container-fluid d-flex justify-content-center mt-4 p-3" div id="topic">
                    <h2 class="text-center">
                        <?php echo $translations->topic;?>
                    </h2>
                    
                </div>
            <!-- Add topic End -->


            <!-- Add question Start -->
                <div class="container-fluid d-flex justify-content-center mt-4 p-3" id="question">
                    <h2 class="text-center">
                        <?php echo $translations->question;?>
                    </h2>
                    
                </div>
            <!-- Add question End -->


            <!-- Settings Start -->
                <div class="container-fluid d-flex flex-column justify-content-center mt-4 p-3" id="settings">
                    <div class="row mt-4 p-3">
                        <h2 class="text-center">
                            <?php echo $translations->settings;?>
                        </h2>
                    </div>
                    <div class="row mt-4 p-3 ">
                        <div class="container-fluid flex-column d-flex align-items-center justify-content-center p-3">
                            <?php foreach($settings as $key=>$value){?>
                                <div class="input-group mb-3 w-50 flex-column d-flex align-items-left">
                                    <label class="form-label w-100" id="<?php echo $key;?>"><?php echo $value->name;?></label>
                                    <input type="text" 
                                            class="settings-input form-control w-100" 
                                            placeholder="<?php echo $value->name;?>" 
                                            aria-label="<?php echo $value->name;?>"
                                            data-key="<?php echo $key;?>"
                                            data-name="<?php echo $value->name;?>" 
                                            value = "<?php echo $value->value;?>"
                                            aria-describedby="<?php echo $key;?>">
                                </div>
                            <?php } ?>            
                        </div>
                        <button class="btn btn-primary " id="save-settings">
                            <?php echo $translations->save_settings;?>
                        </button>
                    </div>
                </div>
            <!-- Settings End -->


            <!-- About Start -->
                <div class="container-fluid d-flex justify-content-center mt-4 p-3 " div id="about">
                    <h2 class="text-center">
                        <?php echo $translations->about;?>
                    </h2>
                </div>
            <!-- About End -->
        </div>
    </div>
</body>
</html>