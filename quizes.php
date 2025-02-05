<?php
session_start();

// Initialize user's overall points if not set
if (!isset($_SESSION['overall_points'])) {
    $_SESSION['overall_points'] = 0;
}

// Get user's nickname and selected topic
$nickname = $_POST['nickname']?? $_SESSION['nickname'];
$topic = $_POST['topic']??$_SESSION['topic'];

// Read questions from the appropriate file
$questions_file = ($topic == 'science') ? 'science.txt' : 'numbers.txt';

/* Debug: Check the file path
echo "Loading questions from: $questions_file<br>";
*/

// Check if the file exists
if (!file_exists($questions_file)) {
    die("Error: The questions file '$questions_file' does not exist.");
}

// Read questions from the file
$questions = file($questions_file, FILE_IGNORE_NEW_LINES);

/* Debug: Check the contents of $questions
echo "<pre>";
print_r($questions);
echo "</pre>";
*/

// Check if $questions is an array and not empty
if (is_array($questions) && !empty($questions)) {
    // Randomly select 3 questions
    $selected_questions = array_rand($questions, min(3, count($questions)));
} else {
    die("Error: No questions found in the file.");
}

//Store the selected questions and topic in the session
$_SESSION['selected_questions'] = $selected_questions;
$_SESSION['questions'] = $questions;
$_SESSION['topic'] = $topic;

// Display the quiz form
echo "<h1>Quiz: " . ucfirst($topic) . "</h1>";
echo "<form action='results.php' method='POST'>";
foreach ($selected_questions as $index) {
    list($question, $answer) = explode('|', $questions[$index]);
    echo "<p>$question</p>";
    if ($topic == 'science') {
        echo "<input type='radio' name='q$index' value='true'> True ";
        echo "<input type='radio' name='q$index' value='false'> False<br>";
    } else {
        echo "<input type='text' name='q$index'><br>";
    }
}
echo "<input type='hidden' name='nickname' value='$nickname'>";
echo "<input type='hidden' name='topic' value='$topic'>";
echo "<button type='submit'>Submit</button>";
echo "</form>";
?>