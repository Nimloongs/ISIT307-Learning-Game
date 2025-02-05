
<?php 
session_start();

// Get user's nickname from session
$nickname = $_SESSION['nickname'] ?? 'Guest';

// Get overall points from session
$overall_points = $_SESSION['overall_points'] ?? 0;

// Save score to file
file_put_contents('scores.txt', "$nickname|$overall_points\n", FILE_APPEND);

echo "<h1>Game Over!</h1>";
echo "<p>$nickname, your overall score is $overall_points!</p>";
echo "<a href='homepage.php'>Start a new game</a>";

// Destroy session to reset game state
session_destroy();
?>
