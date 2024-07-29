<?php
include("variables.php");
$n = "<br>";

//Populate necessary tables to start the game.

$total_players = sizeof($_POST);
$i=1;
$sql = "INSERT INTO players (`player_name`) VALUES";
while ($i <= $total_players){
    $pl = 'player' . $i;
    ${'player' . $i} = $_POST[$pl];
    // echo ${'player' . $i} . $n;
    $sql = $sql . " ('" . ${'player' . $i} . "')";
    if ($i != $total_players){
        $sql = $sql . ", ";
    }
    $i++;
}
mysqli_query($conn, $sql);
mysqli_query($conn, "INSERT INTO wagers (`player_num`) SELECT player_num FROM players");
mysqli_query($conn, "INSERT INTO scores (`player_num`) SELECT player_num FROM players");

header("location:roundStart.php?id=1");

?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Trivia Night</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>

<body>
<h1>Reminders:</h1>
    <div>
    <h2>- Be concise with your answers.</h2>
    <h3>- Do not describe an answer when there is a specific word or phrase for it.</h3>
    <h3>- You will not be asked to specify your answer. It'll just be wrong.</h3>
    <h4>Ex: Q) What Colts' QB wore #18?<br> If you answer "Manning", it is wrong.</h4>
    <h2>- Questions should seek clarification, not information.</h2>
    <h3>- No hints unless the whole party is visibly stumped.</h3>
    <h3>- The judge reserves the right to not answer any questions.</h3>
    <h2 align="center">- The writer of the questions reserves final judgment of all answers.</h2>
    </div>
    <div>
    <button align="center" onclick="window.location.href='roundStart.php?id=1'" id="reset">Begin Round 1 ></button>
    </div>
    <br>
    <br>
</body>