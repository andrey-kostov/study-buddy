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
}
?>