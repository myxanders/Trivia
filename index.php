<?php
include("variables.php");
session_start();
$n = "<br>";
?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Trivia Night</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<script>
    function newPlayer() {
        var table = document.getElementById("table");
        var player_num = parseInt(table.rows[1].cells[0].innerHTML);
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var y = player_num + 1;
        var player_name = 'player' + y;
        console.log(player_name);
        cell1.innerHTML = y;
        cell2.innerHTML = "<input type='text' name = " + player_name + " style='width: 250px;'>";
    }
</script>

<body>
    <h1>Trivia Night</h1>
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM questions WHERE question IS NOT NULL");
    if (mysqli_num_rows($sql) == 0) {
    ?>
        <h2>You must add questions before you start Trivia.</h2>
        <div>
            <button style="font-size: 32px;" onclick="window.location.href='addQuestions.php'">Add Questions</button>
        </div>
    <?php
    } else {
    ?>
        <div>
            <form action="startGame.php" method="post">
                <table id="table">
                    <tr>
                        <th sytle="width: 100px;">No.</th>
                        <th style="width: 300px;">Player</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="player1" style="width: 250px;"></td>
                    </tr>
                </table>
                <div id="buttons">
                    <button align="center" type="button" onclick="newPlayer()">Add Player</button>
                    <br>
                    <button align="center" type="submit">Start Game</button>
                </div>
            </form>
        </div>
        <?php
        $query = mysqli_query($conn, "SELECT SUM(final) AS done FROM scores");
        $q = mysqli_fetch_array($query);
        $end = $q['done'];
        if ($end != NULL) {
        ?>
            <div id="buttons">
                <br>
                <button align="center" onclick="window.location.href='resetGame.php'" id="reset">Reset Game</button>
            </div>
    <?php
        }
    }
    ?>
</body>

</html>
<style>
    button#reset {
        background-color:crimson;
        color:white;
    }

    button#reset:hover {
        background-color: black;
        color: yellow;
    }
</style>