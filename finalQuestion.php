<?php
include("variables.php");
session_start();
$n = "<br>";
$_SESSION['id'] = 7;

$sql = mysqli_query($conn, "SELECT * FROM questions WHERE question_num = 20");
$r = mysqli_fetch_array($sql);
$qst = $r['question'];
?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Final Question</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>

<body>
    <div>
        <h1>Final Question</h1>
        <h2 style="text-align: center; max-width: 800px;"><?php echo $qst; ?></h2>
        <br>
        <table>
            <tr>
                <th>Options</th>
            </tr>
        <?php
            $query = mysqli_query($conn, "SELECT * FROM final_answers ORDER BY description ASC");
            $i=1;
            while ($i <= mysqli_num_rows($query) && $q = mysqli_fetch_array($query)){
                $opt = $q['description'];
        ?>
            <tr>
                <td style="background-color: white; color: black;"><?php echo $opt;?></td>
            </tr>
        <?php
            $i++;
            }
        ?>
        </table>
        <!-- When players have answers ready, we take down wagers so they cannot change their wager after seeing they were
             right or wrong. -->
        <form action="finalAnswers.php" method="post">
            <br>
            <br>
            <table>
                <tr>
                    <th style="width: 200px;">Player</th>
                    <th style="width: 75px;">Wager</th>
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
                        <td><input type="number" name="<?php echo 'wager' . $pid; ?>" style="width: 50px;"></td>
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
        <br>
    </div>
</body>
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