<?php 
header("Content-Type: application/json;charset=utf-8");
$action = $_POST['action'];

switch($action){
    case'save_settings':
        $settings = $_POST['settings'];
        $settingsJson = json_encode($settings);
        file_put_contents("includes/settings.json",$settings);
    break;

    case'save_subject':
        $subject = $_POST['subject'];
        if(is_dir('questions/'.$subject)){
            echo 'Subject exists!';
        }else{
            echo 'Subject created!';
            mkdir("questions/".$subject, 0755);
        }
    break;

    case'save_topic':
        $subject = $_POST['subject'];
        $topic = $_POST['topic'];
        $filename = 'questions/'.$subject.'/'.$topic.'.json';

        if(file_exists($filename)){
            echo 'Topic exists!';
        }else{
            echo 'Topic created!';
            $file = fopen($filename, "w");
            fclose($file);
        }
    break;

    case'selected_subject':
        $selected_subject = $_POST['selected_subject'];
        $dir_name = 'questions/'.$selected_subject;
        $topics = glob($dir_name."/*.json");
        $readyTopics = [];
        foreach($topics as $topic){
            $topicArray = explode('/',$topic);
            $topicName = explode('.',$topicArray[2]);
            array_push($readyTopics,$topicName[0]);
        }
        echo json_encode($readyTopics);
    break;

    case'save_question':
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = $_POST['option3'];
        $correct_option = $_POST['correct_option'];
        $question = $_POST['question'];
        $subject = $_POST['subject'];
        $topic = $_POST['topic'];

        $json_location = 'questions/'.$subject.'/'.$topic.'.json';
        
        $questionObject['question'] = $question;
        $questionObject['option1'] = $option1;
        $questionObject['option2'] = $option2;
        $questionObject['option3'] = $option3;
        $questionObject['correct_option'] = $correct_option;
        $questionArray = (array)$questionObject;

        $data_results = file_get_contents($json_location);
        $temporary_array = json_decode($data_results);

        $temporary_array[] = $questionArray ;
        $json_data = json_encode($temporary_array);

        file_put_contents($json_location, $json_data);
        
        echo 'Question saved!';
    break;
}
?>