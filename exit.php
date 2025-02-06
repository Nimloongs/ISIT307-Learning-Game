<?php 
session_start();

// Get user's nickname from session
$nickname = $_POST['nickname'] ?? $_SESSION['nickname'];

// Get overall points from session
$overall_points = $_SESSION['overall_points'] ?? 0;

// Save score to file
file_put_contents('scores.txt', "$nickname|$overall_points\n", FILE_APPEND);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="quiz-container">
    <h1>Game Over!</h1>
    <p><?php echo htmlspecialchars($nickname); ?>, your overall score is <?php echo htmlspecialchars($overall_points); ?>!</p>
    <a href="homepage.php" class="link-button">Start a new game</a>
</div>

</body>
</html>
