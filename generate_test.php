<?php
session_start();

$topicsArray = $_SESSION['topicsArray'];
$type = $_SESSION['type'];

$questionsArray = [];

foreach ($topicsArray as $topic){
    $thisQuestions = json_decode(file_get_contents('questions/'.$topic));
    foreach ((array)$thisQuestions as $question){
        array_push($questionsArray,$question);
    }
}

function shuffleArray($array){
    // Get array length
    $count = count($array);
    // Create a range of indicies
    $indi = range(0,$count-1);
    // Randomize indicies array
    shuffle($indi);
    // Initialize new array
    $newarray = array($count);
    // Holds current index
    $i = 0;
    // Shuffle multidimensional array
    foreach ($indi as $index){
        $newarray[$i] = $array[$index];
        $i++;
    }
    return $newarray;
}

$questions = shuffleArray($questionsArray);

$settings = json_decode(file_get_contents('includes/settings.json'));

$settingClosedQuestions = $settings->numberQstsClosed->value;
$settingOpenQuestions = $settings->numberQstsFree->value;
$settingFail = $settings->failPercent->value;

if($type == "closed"){
    $questionsToTest = array_slice($questions, 0, $settingClosedQuestions);
}else{
    $questionsToTest = array_slice($questions, 0, $settingOpenQuestions);
}

var_dump($questionsToTest);

?>