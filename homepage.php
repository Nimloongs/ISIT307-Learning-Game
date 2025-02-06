<?php
    // Start session if needed
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to the Learning Game!</h1>
    <form action="quizes.php" method="POST">
        <label for="nickname">Enter your nickname:</label>
        <input type="text" id="nickname" name="nickname" required>
        <br><br>
        <!-- Science and Nature Quiz Button -->
        <button type="submit" name="topic" value="science">Science and Nature Quiz</button>
        <!-- Numbers Quiz Button -->
        <button type="submit" name="topic" value="numbers">Numbers Quiz</button>
    </form>
    <br>
    <a href="leaderboard.php">View Leaderboard</a>
    <br><br>
    </div>
</body>
</html>
