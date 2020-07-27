<?php
include("variables.php");
session_start();
$n = "<br>";

$round_id = $_SESSION['id'];

//Halftime question was assigned the question_num of 19 as it is not one of the standard 18 questions.
$sql = mysqli_query($conn, "SELECT * FROM questions WHERE question_num = 19");
$r = mysqli_fetch_array($sql);
$qst = $r['question'];

?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Halftime Question</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<script>
// Reveals all possible correct answers at once.
    function showAnswer() {
        document.getElementById("answer").style.display = "block";
    }
</script>

<!-- Mark how many correct answers players wrote down. -->
<body>
    <div>
        <h1>Halftime Question:</h1>
        <h2 style="text-align: center; max-width: 800px;"><?php echo $qst; ?></h2>
        <br>
        <table id="answer" class="answer">
            <tr>
                <th>Correct Answers:</th>
            </tr>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM halftime_answers ORDER BY answers ASC");
            $i = 1;
            while ($i <= mysqli_num_rows($query) && $r = mysqli_fetch_array($query)) {
                $ans = $r['answers'];
            ?>
                <tr>
                    <td><?php echo $ans; ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
        <form action="answerHalf.php" method="post">
            <br>
            <table>
                <tr>
                    <th style="width: 200px;">Player</th>
                    <th>Correct</th>
                </tr>
                <?php
                $pls = mysqli_query($conn, "SELECT * FROM players");
                $i = 1;
                while ($i <= mysqli_num_rows($pls) && $p = mysqli_fetch_array($pls)) {
                    $pid = $p['player_num'];
                    $player = $p['player_name'];
                ?>
                    <tr>
                        <td><?php echo $player; ?></td>
                        <td>
                            <select style="width: 50px;" name="<?php echo 'wager' . $pid; ?>">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
            <div>
                <button align="center" type="submit">Submit Answers</button>
            </div>
        </form>
        <div style="margin-bottom: 30px;">
            <button align="center" onclick="showAnswer()"><b>SHOW ANSWERS</b></button>
        </div>
        <br>
    </div>
</body>
<style>
    table#answer {
        display: none;
    }
    table.answer td {
        background-color: white;
        color: black;
    }
</style>