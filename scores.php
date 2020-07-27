<?php
include("variables.php");
session_start();
$n = "<br>";
$rd = $_SESSION['id'];

// Displaying the leaderboard
$sql = mysqli_query($conn, "SELECT * FROM players ORDER BY pts DESC");
?>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Trivia Scoreboard</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<?php
// At the end of the game, the winners gets their name flashing in rainbow colors. Music is added for fun.
	if ($rd == 7){
		echo '<script>';
    echo'var colors = ["red", "orange","yellow", "green", "blue", "purple", "violet"];';
    echo'var texts = ["white", "black", "black", "white", "white", "white", "black"];';
    echo'var count = 0;';

    echo'function colorChanging(){';
        echo'var x = document.getElementById("place1");';
        echo'var i = document.getElementById("counter");';
        echo'var y = parseInt(i.innerHTML);';
        echo'var pointer = (y % 7);';
        echo'x.style.backgroundColor = colors[pointer];';
        echo'x.style.color = texts[pointer];';
        echo'i.innerHTML = y + 1;';
    echo'}';
    echo'setInterval(function() {';
     echo'           colorChanging();';
     echo'       }, 1000);';
echo'</script>';
    echo'<audio autoplay>';
    echo'    <source src="Celebrate.mp3" type = "audio/mpeg">';
    echo'</audio>';
    echo'<p><span id="counter" style="display:none;">0</span></p>';
	}
	?>

<body>
    <div>
        <?php
        if ($rd <= 6) {
        ?>
            <h1>Leaderboard</h1>
        <?php
        } elseif ($rd > 6) {
        ?>
            <h1>Final Scores</h1>
        <?php
        }
        ?>
        <table>
            <tr>
                <th style="width: 100px;">Place</th>
                <th style="width: 300px;">Player</th>
                <th style="width: 100px;">Score</th>
            </tr>
            <?php
            $i = 1;
            while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)) {
                $player = $r['player_name'];
                $pts = $r['pts'];
            ?>
                <tr id="place<?php echo $i;?>">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $player; ?></td>
                    <td><?php echo $pts; ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
    </div>
    <br>
    <div>
        <!-- For transparency's sake, a record of correct/incorrect answers and how many points were earned on each question. -->
        <table  id="breakdown">
            <tr>
                <th class="boop"></th>
                <?php
                    $z = 3*$rd;
                    if ($z > 18){
                        $z = 18;
                    }       
                    $sql = mysqli_query($conn, "SELECT category FROM questions WHERE question_num <= $z");
                    $j = 1;
                    while ($j <= $z && $r = mysqli_fetch_array($sql)){
                        $cat_num = $r['category'];
                        $qtext = "SELECT category FROM categories WHERE category_id = $cat_num";
                        $query = mysqli_query($conn, $qtext);
                        $q = mysqli_fetch_array($query);
                        $cat = $q['category'];
                        echo '<th>' . $cat . '</th>';
                        $j++;
                    }
                    echo '<th>Half</th>';

                    if ($rd > 6){
                        echo '<th>Final</th>';
                    }
                ?>
            </tr>
            <?php
                $sql = mysqli_query($conn, "SELECT * FROM scores");
                $k = 1;
                while ($k <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)){
                    echo '<tr>';
                    $m = 1;
                    $pid = $r['player_num'];
                    $half = $r['halftime'];   
                    $final = $r['final'];                 
                    $nameq = mysqli_query($conn, "SELECT * FROM players WHERE player_num = $pid");
                    $nq = mysqli_fetch_array($nameq);
                    $name = $nq['player_name'];
                    echo '<td class="playerz">' . $name . '</td>';
                    while ($m <= $z){
                        $col = 'question' . $m;
                        $pts = $r[$col];
                        if ($pts > 0){
                            echo '<td id="right">'. $pts . '</td>';
                        }
                        elseif ($pts == 0){
                            echo '<td id="wrong">X</td>';
                        }                     
                        $m++;
                    }
                    if ($half > 0){
                        echo '<td id="right">'. $half . '</td>';
                    }
                    elseif ($half == 0){
                        echo '<td id="wrong">-</td>';
                    }   
                    if ($final != NULL && $rd > 6){
                        if ($final > 0){
                            echo '<td id="right">' . $final . '</td>';
                        }
                        elseif ($final < 0){
                            echo '<td id="wrong">' . $final . '</td>';
                        }
                        elseif ($final == 0){
                            echo '<td>0</td>';
                        }
                    }                    
                    echo '</tr>';
                    $k++;
                }
            ?>
        </table>
    </div>
    <div>
        <?php
        if ($rd <= 3) {
        ?>
            <button onclick="window.location.href='roundStart.php?id=4'">Begin Second Half</button>
        <?php
        } elseif ($rd > 3 && $rd <= 6) {
        ?>
            <button onclick="window.location.href='finalQuestion.php'">Final Question</button>
            
        <?php
        } elseif ($rd > 6) {
        ?>
            <button onclick="window.location.href='index.php'">End Game</button>
        <?php
        }
        ?>
    </div>
</body>

</html>
<style>

    tr#place1 {
        background-color: darkgoldenrod;
        color: black;
    }
    tr#place2 {
        background-color: lightslategray;
        color: black;
    }
    tr#place3 {
        background-color: chocolate;
        color: black;
    }

    td#right{
        background-color: green;
        color: white;
    }

    td#wrong {
        background-color: darkred;
    }

    #breakdown{
        display:block;
        max-width: 1000px;
        overflow-x: scroll;
        margin-left: 110px;
    }

    #breakdown th {
        min-width: 100px;
    }

    .playerz {
        position: absolute;
        left: 100;
        top: auto;
        width: 150px;
        background-color: gold;
    }
    .boop {
        border: none;
        position: absolute;
        left: 100;
        top: auto;
        width: 150px;
        background:none;        
    }

	#breakdown {
		scrollbar-color: gold navy;
	}

</style>