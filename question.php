<?php
include("variables.php");
session_start();
$n = "<br>";
$question_id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM questions WHERE question_num = $question_id");
$r = mysqli_fetch_array($sql);
$qst = $r['question'];
$cat = $r['category'];
$ans = $r['answer'];
$query = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $cat");
$q = mysqli_fetch_array($query);
$category = $q['category'];
?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Trivia Question <?php echo $question_id;?></title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<script>
// Display the answer once all wagers are set and answers are submitted.
    function showAnswer() {
        document.getElementById("answer").style.display = "block";
    }
</script>
<body>
    <div>
    <h1>Question <?php echo $question_id . " - " . $category;?>:</h1>
    <h3 id="answer"><?php echo $ans;?></h3>
    <h2 style="text-align: center; max-width: 800px;"><?php echo $qst;?></h2>
    <br>
    <form action = "answerQuestions.php?id=<?php echo $question_id;?>" method = "post">
    <!-- Mark the wager used by each player. -->
    <table>
        <tr>
            <th style="width: 200px;">Player</th>
            <th>Wager</th>
            <th>Correct?</th>
        </tr>
        <?php
            $pls = mysqli_query($conn, "SELECT * FROM players");
            $i=1;
            while ($i <= mysqli_num_rows($pls) && $p = mysqli_fetch_array($pls)){
                $pid = $p['player_num'];
                $player = $p['player_name'];
        ?>
                <tr>
                    <td><?php echo $player;?></td>
                    <td>
                        <?php
                            $wsql = mysqli_query($conn, "SELECT * FROM wagers WHERE player_num = $pid");
                            $w = mysqli_fetch_array($wsql);
                            $low = $w['low_wager'];
                            $med = $w['med_wager'];
                            $hi = $w['high_wager'];

                            if ($low != NULL){
                                echo '<input type="radio" id="low" name="wager' . $pid . '" value=' . $low . ' checked >';
                                echo '<label style="color:navy;">' . $low . ' | </label>';
                            }
                            if ($med != NULL){
                                echo '<input type="radio" id="med" name="wager' . $pid . '" value=' . $med . ' checked >';
                                echo '<label style="color:green;">' . $med . ' | </label>';
                            }
                            if ($hi != NULL){
                                echo '<input type="radio" id="high" name="wager' . $pid . '" value=' . $hi . ' checked >';
                                echo '<label style="color:purple;">' . $hi . ' | </label>';
                            }
                        ?>
                        </td>   
                    <td><input type="checkbox" id="correct" name="<?php echo 'rightwrong' . $pid;?>"></td>                 
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
        <button align="center" onclick="showAnswer()"><b>SHOW ANSWER</b></button>
    </div>
    <br>
    </div>
</body>
<style>
    h3#answer {
        display: none;
    }

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
	}

	input[type="radio"] {
		width: 13px;
		height: 13px;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		border: 1px solid black;
		border-radius: 10px;
	}

	input[type="radio"]#low:checked {
		background-color: navy;
	}

    input[type="radio"]#med:checked {
		background-color: green;
	}

    input[type="radio"]#high:checked {
		background-color: purple;
	}

</style>