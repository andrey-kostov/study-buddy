<?php
    session_start();

    $translationsJson = file_get_contents('includes/translations.json');
    $translations = json_decode($translationsJson);

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
        $count = count($array); // Get array length
        $indi = range(0,$count-1); // Create a range of indicies
        shuffle($indi); // Randomize indicies array
        $newarray = array($count); // Initialize new array
        $i = 0; // Holds current index
        foreach ($indi as $index){ // Shuffle multidimensional array
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
        $numberOfQuestions = $settingClosedQuestions;
        $questionsToTest = array_slice($questions, 0, $numberOfQuestions);
    }else{
        $numberOfQuestions = $settingOpenQuestions;
        $questionsToTest = array_slice($questions, 0, $numberOfQuestions);
    } 

    include('includes/templates/header.php'); 
?>

    <div id="test-body" class="container-fluid">
        <?php foreach($questionsToTest as $question){ ?>
        <div class="row question-wrapper">
            <p class="question-text lead">
                <?php echo $question->question;?>
            </p>
            <div class="answers-wrapper">
                <button style="order:<?php echo rand(0, 3);?>" class="option btn btn-outline-dark"><?php echo $question->option1;?></button>
                <button style="order:<?php echo rand(0, 3);?>" class="option btn btn-outline-dark"><?php echo $question->option2;?></button>
                <button style="order:<?php echo rand(0, 3);?>" class="option btn btn-outline-dark"><?php echo $question->option3;?></button>
                <button style="order:<?php echo rand(0, 3);?>" class="option btn btn-outline-dark correct"><?php echo $question->correct_option;?></button>
            </div>
        </div>
        <?php } ?>
    </div>

    <div id="results-bar">
        <?php echo $translations->result;?><span id="answers">0</span>/<span id="total-answers"><?php echo $numberOfQuestions;?></span>
    </div>

<?php include('includes/templates/footer.php');
