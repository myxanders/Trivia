<?php
include("variables.php");
session_start();
$n = "<br>";
$sp = "&nbsp";
$tab = $sp . $sp . $sp . $sp;

//Collect final wagers
$sql = mysqli_query($conn, "SELECT * FROM players ORDER by player_num ASC");
$j = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    while ($j <= mysqli_num_rows($sql) && $q = mysqli_fetch_array($sql)) {
        $pid = $q['player_num'];
        $wager = 'wager' . $pid;
        if (isset($_POST[$wager])) {
            ${'wager' . $pid} = $_POST[$wager];
        }
        $j++;
    }
}

$query = mysqli_query($conn, "SELECT * FROM players");
$k = 1;
while ($k <= mysqli_num_rows($query) && $q = mysqli_fetch_array($query)) {
    $pid = $q['player_num'];
    $p_wager = ${'wager' . $pid};
    mysqli_query($conn, "UPDATE scores SET final = $p_wager WHERE player_num = $pid");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Final Answers</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<script>
// Reveal the correct answers one at a time. This builds suspense and mimics the in-person method of revealing answers.
    var answers = ['answer1', 'answer2', 'answer3', 'answer4'];

    function showAnswer() {
        console.log(answers);
        var ans = answers[0];
        console.log(ans);
        document.getElementById(ans).removeAttribute("style");
        answers.splice(0, 1);
    }
</script>

<body>
    <h1>Final Question Answers</h1>
    <h2>The correct order was:</h2>
    <div>
        <button align="center" type="button" onclick="showAnswer()" style="margin-top:0px;">Show Next Answer</button>
    </div>
    <br>
    <div>
        <table id="table">
            <tr>
                <th sytle="width: 100px;">Rank</th>
                <th style="width: 500px;">Description</th>
                <th style="width: 100px;">Value</th>
            </tr>
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM final_answers ORDER BY rank ASC");
            $i = 1;
            while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)) {
                $id = 'answer' . $i;
                $ans = $r['description'];
                $val = $r['value'];
            ?>
                <tr id="<?php echo $id; ?>" style="display:none;">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ans; ?></td>
                    <td><?php echo $val; ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
        <br>
        <!-- With wagers already in, mark who got the order correct. -->
        <form action="finalTally.php" method="post">
            <br>
            <br>
            <table>
                <tr>
                    <th style="width: 300px;">Player</th>
                    <th style="width: 75px;">Right?</th>
                </tr>
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM players ORDER BY player_num ASC");
                $i = 1;
                while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)) {
                    $player = $r['player_name'];
                    $pid = $r['player_num'];
                ?>
                    <tr>
                        <td><?php echo $player; ?></td>
                        <td><input type="checkbox" id="correct" name="<?php echo 'rightwrong' . $pid; ?>"></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
            <div>
                <button align="center" type="submit">Tally Scores</button>
            </div>
        </form>
    </div>
</body>

</html>
<style>
    input[type="checkbox"] {
        width: 16px;
        height: 16px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 3px;
        border: 1px solid black;
    }

    input[type="checkbox"]:checked {
        background-color: greenyellow;
        border-radius: 3px;
        border: 1px solid white;
    }
</style>