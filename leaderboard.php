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

echo "<h1>Leaderboard |</h>";
echo "Sort by: ";
echo "<a href='leaderboard.php?sort=name'>Name</a> | ";
echo "<a href='leaderboard.php?sort=score'>Score</a>";
echo "<table>";
echo "<tr><th>Nickname</th><th>Score</th></tr>";
foreach($leaderboard as $name => $score){
    echo "<tr><td>$name</td><td>$score</td></tr>";
}
echo "</table>";
echo "<a href='homepage.php'>Start a new game</a>";

?>