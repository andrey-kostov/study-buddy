<?php 
    $settingsJson = file_get_contents('includes/settings.json');
    $settings = json_decode($settingsJson);

    $translationsJson = file_get_contents('includes/translations.json');
    $translations = json_decode($translationsJson);

    //Get all subject if any exist
    $subjects = glob("questions/*");
    // var_dump(count($subjects));
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
            <a class="nav-link mx-3" href="#question"><?php echo $translations->add_question;?></a>
            <a class="nav-link mx-3" href="#settings"><?php echo $translations->settings;?></a>
            <a class="nav-link mx-3" href="#about"><?php echo $translations->about;?></a>
        </div>
    </nav>
    <!-- Navigation End -->

    <div id="wrapper" class="container-fluid p-3">
        <div id="content-wrapper" >
            <h1><?php echo $settings->projectName->value;?></h1>

            <!-- Generate test Start -->
                <div class="container-fluid d-flex flex-column justify-content-center mt-4 p-3" id="generate">
                    <div class="row mt-4">
                        <h2 class="text-center">
                            <?php echo $translations->generate;?>
                        </h2>
                    </div>
                    <div class="row mt-4">
                        <h3 class="text-center">
                            <?php echo $translations->pick_subjects;?>
                        </h3>
                    </div>
                    <div class="row">
                    <?php if(count($subjects) > 0){
                        $indexSubject = 0;
                        foreach($subjects as $subject){
                            $indexTopic = 0;
                            $subjectArray = explode('/',$subject); ?>
                            <div class="row mt-4">
                                <h4><?php echo $subjectArray[1];?></h4>
                                <?php $topics = glob($subject.'/*.json');
                                foreach($topics as $topic){ $topicArray = explode('/',$topic); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox-<?php echo $indexSubject,$indexTopic;?>">
                                        <label class="form-check-label" for="checkbox-<?php echo $indexSubject,$indexTopic;?>">
                                            <?php echo $topicArray[2];?>
                                        </label>
                                    </div>
                                <?php $indexTopic++;} ?>
                            </div>
                            
                    <?php }} $indexSubject++; ?>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" id="generate-closed"><?php echo $translations->generate_closed;?></button>
                        <button class="btn btn-primary" id="generate-open"><?php echo $translations->generate_open;?></button>
                    </div>    
                </div>
                <!-- Generate test End -->
                
                
                <!-- Add subject Start -->
                <div class="container-fluid d-flex flex-column justify-content-center mt-4 p-3" id="subject">
                    <div class="row  mt-4">
                        <h2 class="text-center">
                            <?php echo $translations->subject;?>
                        </h2>
                    </div>
                    <div class="row mt-4">
                        
                        <input type="text" class="form-control w-100" placeholder="<?php echo $translations->subject;?>">
                        <button class="btn btn-primary">
                            <?php echo $translations->save_subject;?>
                        </button>
                    </div>
                </div>
            <!-- Add subject End -->


            <!-- Add topic Start -->
                <div class="container-fluid d-flex flex-column justify-content-center mt-4 p-3" div id="topic">
                    <div class="row  mt-4">
                        <h2 class="text-center">
                            <?php echo $translations->topic;?>
                        </h2>
                    </div>
                    <div class="row mt-4">
                        <select class="form-select mb-3" name="subject-select" id="subject-select">
                            <option value=""><?php echo $translations->select_subject;?></option>
                            <?php if(count($subjects) > 0){
                                foreach($subjects as $subject){
                                    $subjectArray = explode('/',$subject); ?>
                                    <option value="<?php echo $subjectArray[1];?>"><?php echo $subjectArray[1];?></option>
                            <?php }} ?>
                        </select>
                        <input type="text" class="form-control w-100" placeholder="<?php echo $translations->topic;?>">
                        <button class="btn btn-primary">
                            <?php echo $translations->save_topic;?>
                        </button>
                    </div>
                </div>
            <!-- Add topic End -->


            <!-- Add question Start -->
                <div class="container-fluid d-flex flex-column justify-content-center mt-4 p-3" id="question">
                    <div class="row mt-4">
                        <h2 class="text-center">
                            <?php echo $translations->add_question;?>
                        </h2>
                    </div>
                    <div class="row mt-4">
                        <select class="form-select mb-3" name="question-subject-select" id="question-subject-select">
                            <option value=""><?php echo $translations->select_subject;?></option>
                            <?php if(count($subjects) > 0){
                                foreach($subjects as $subject){
                                    $subjectArray = explode('/',$subject); ?>
                                    <option value="<?php echo $subjectArray[1];?>"><?php echo $subjectArray[1];?></option>
                            <?php }} ?>
                        </select>
                        <select class="form-select mb-3" name="question-topic-select" id="question-topic-select">
                        <option value=""><?php echo $translations->select_topic;?></option>
                        </select>
                        <input type="text" class="form-control mb-3 w-100" data-name="question" placeholder="<?php echo $translations->question;?>">
                        <input type="text" class="form-control mb-3 w-100" data-name="correct" placeholder="<?php echo $translations->correct;?>">
                        <input type="text" class="form-control mb-3 w-100" data-name="option1" placeholder="<?php echo $translations->option;?>">
                        <input type="text" class="form-control mb-3 w-100" data-name="option2" placeholder="<?php echo $translations->option;?>">
                        <input type="text" class="form-control mb-3 w-100" data-name="option3" placeholder="<?php echo $translations->option;?>">
                        <button class="btn btn-primary">
                            <?php echo $translations->save_question;?>
                        </button>
                    </div>
                </div>
            <!-- Add question End -->


            <!-- Settings Start -->
                <div class="container-fluid d-flex flex-column justify-content-center mt-4 p-3" id="settings">
                    <div class="row mt-4">
                        <h2 class="text-center">
                            <?php echo $translations->settings;?>
                        </h2>
                    </div>
                    <div class="row mt-4">
                        <div class="container-fluid flex-column d-flex align-items-center justify-content-center">
                            <?php foreach($settings as $key=>$value){?>
                                <div class="w-100 mb-3 flex-column d-flex align-items-left">
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