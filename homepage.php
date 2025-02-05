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
    <style>
        /* General Styling */
        body {
            background-color:rgb(255, 255, 255);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
            color: #555;
        }

        input[type="text"] {
            width: 90%; /* Shorter input field */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
