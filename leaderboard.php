<?php
//Read sources from the file
$scores_file = 'scores.txt';
if(!file_exists($scores_file)){
    die("Error: Scores file not found");
}

$scores = file('scores.txt', FILE_IGNORE_NEW_LINES);
$leaderboard = [];

foreach($scores as $line){
    list($name, $score) = explode('|', $line);
    $leaderboard[$name] = $score;
}

//Determine the sorting method
$sort = $_GET['sort'] ?? 'score';

//Sort by nickname or score
if ($sort == 'name'){
    ksort($leaderboard);
} else {
    arsort($leaderboard);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="quiz-container">
    <h1>Leaderboard</h1>
    <p>Sort by: 
        <a href="leaderboard.php?sort=name">Name</a> | 
        <a href="leaderboard.php?sort=score">Score</a>
    </p>

    <table>
        <tr>
            <th>Nickname</th>
            <th>Score</th>
        </tr>
        <?php foreach($leaderboard as $name => $score): ?>
            <tr>
                <td><?php echo htmlspecialchars($name); ?></td>
                <td><?php echo htmlspecialchars($score); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="homepage.php" class="link-button">Start a new game</a>
</div>

</body>
</html>
