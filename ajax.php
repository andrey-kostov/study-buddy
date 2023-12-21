<?php 
header("Content-Type: application/json;charset=utf-8");
$action = $_POST['action'];

switch($action){
    case'save_settings':
        $settings = $_POST['settings'];
        $settingsJson = json_encode($settings);
        file_put_contents("includes/settings.json",$settings);
    break;

}
?>