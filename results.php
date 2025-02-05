<?php
session_start();

// Get user's nickname
$nickname = $_POST['nickname'] ?? $_SESSION['nickname'];

// Retrieve selected questions and answers from session
$selected_questions = $_SESSION['selected_questions'];
$questions = $_SESSION['questions'];
$topic = $_SESSION['topic'];

// Initialize Counters
$correct = 0;
$incorrect = 0;

// Check the user's answers
foreach ($selected_questions as $index) {
    $user_answer = $_POST["q$index"] ?? null; // Get the user's answer
    list($question, $correct_answer) = explode('|', $questions[$index]);

    if ($user_answer == $correct_answer) {
        $correct++;
    } else {
        $incorrect++;
    }
}

// Calculate the total score for the quiz
$quiz_score = ($correct * 3) - ($incorrect * 2);

// Load existing scores from file
$scores_file = 'scores.txt';
$scores = [];

if (file_exists($scores_file)) {
    $lines = file($scores_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($stored_nickname, $stored_score) = explode('|', $line);
        $scores[$stored_nickname] = (int)$stored_score;
    }
}

// Update the user's overall score
$scores[$nickname] = ($scores[$nickname] ?? 0) + $quiz_score;
$_SESSION['overall_points'] = $scores[$nickname];

// Save updated scores back to file
$updated_content = "";
foreach ($scores as $user => $score) {
    $updated_content .= "$user|$score\n";
}
file_put_contents($scores_file, $updated_content);

// Display the Results
echo "<h1>Quiz Results</h1>";
echo "<p>Correct Answers: $correct</p>";
echo "<p>Incorrect Answers: $incorrect</p>";
echo "<p>Quiz Score: $quiz_score</p>";
echo "<p><strong>$nickname's Overall Points: </strong>" . $_SESSION['overall_points'] . "</p>";

// For Science quiz
echo "<form action='quizes.php' method='POST'>";
echo "<input type='hidden' name='topic' value='science'>";
echo "<button type='submit'>New Science Quiz</button>";
echo "</form><br>";

// For Numbers quiz
echo "<form action='quizes.php' method='POST'>";
echo "<input type='hidden' name='topic' value='numbers'>";
echo "<button type='submit'>New Numbers Quiz</button>";
echo "</form><br>";

// View Leaderboard link (no session update)
echo "<a href='leaderboard.php'>View Leaderboard</a><br>";

// Exit link (no session update)
echo "<a href='exit.php'>Exit</a><br>";

?>
