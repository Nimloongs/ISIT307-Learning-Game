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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="result-container">
        <h1>Quiz Results</h1>
        <p>Correct Answers: <?php echo $correct; ?></p>
        <p>Incorrect Answers: <?php echo $incorrect; ?></p>
        <p>Quiz Score: <?php echo $quiz_score; ?></p>
        <p><strong><?php echo $nickname; ?>'s Overall Points: </strong><?php echo $_SESSION['overall_points']; ?></p>

        <!-- For Science quiz -->
        <form action="quizes.php" method="POST" class="quiz-button-form">
            <input type="hidden" name="topic" value="science">
            <input type="hidden" name="nickname" value="<?php echo $nickname; ?>">
            <button type="submit">New Science Quiz</button>
        </form><br>

        <!-- For Numbers quiz -->
        <form action="quizes.php" method="POST" class="quiz-button-form">
            <input type="hidden" name="topic" value="numbers">
            <input type="hidden" name="nickname" value="<?php echo $nickname; ?>">
            <button type="submit">New Numbers Quiz</button>
        </form><br>

        <!-- View Leaderboard link (no session update) -->
        <a href="leaderboard.php" class="link-button">View Leaderboard</a><br>

        <!-- Exit link (using a hidden form to pass nickname) -->
<form action="exit.php" method="POST" class="quiz-button-form">
    <input type="hidden" name="nickname" value="<?php echo $nickname; ?>">
    <button type="submit">Exit</button>
</form><br>
    </div>
</body>
</html>
