<?php
session_start();

// Initialize user's overall points if not set
if (!isset($_SESSION['overall_points'])) {
    $_SESSION['overall_points'] = 0;
}

// Get user's nickname and selected topic
$nickname = $_POST['nickname'] ?? $_SESSION['nickname'];
$topic = $_POST['topic'] ?? $_SESSION['topic'];

// Read questions from the appropriate file
$questions_file = ($topic == 'science') ? 'science.txt' : 'numbers.txt';

// Check if the file exists
if (!file_exists($questions_file)) {
    die("Error: The questions file '$questions_file' does not exist.");
}

// Read questions from the file
$questions = file($questions_file, FILE_IGNORE_NEW_LINES);

// Check if $questions is an array and not empty
if (is_array($questions) && !empty($questions)) {
    // Randomly select 3 questions
    $selected_questions = array_rand($questions, min(3, count($questions)));
} else {
    die("Error: No questions found in the file.");
}

// Store the selected questions and topic in the session
$_SESSION['selected_questions'] = $selected_questions;
$_SESSION['questions'] = $questions;
$_SESSION['topic'] = $topic;

// Display the quiz form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz: <?php echo ucfirst($topic); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz: <?php echo ucfirst($topic); ?></h1>
        <form action="results.php" method="POST">
            <?php
            foreach ($selected_questions as $index) {
                list($question, $answer) = explode('|', $questions[$index]);
                echo "<div class='question'>";
                echo "<p>$question</p>";
                if ($topic == 'science') {
                    echo "<label><input type='radio' name='q$index' value='true'> True</label>";
                    echo "<label><input type='radio' name='q$index' value='false'> False</label><br>";
                } else {
                    echo "<input type='text' name='q$index' class='text-input'><br>";
                }
                echo "</div>";
            }
            ?>
            <input type="hidden" name="nickname" value="<?php echo $nickname; ?>">
            <input type="hidden" name="topic" value="<?php echo $topic; ?>">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
