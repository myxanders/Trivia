<?php
include("variables.php");
session_start();
$n = "<br>";
//Question number of the question that was just answered.
$question_num = $_GET['id'];

// In the first half, players may use wagers of 2, 4, and 6 points.
if ($question_num <= 9){
    $low = 2;
    $med = 4;
    $high = 6;
}
// In the second half, players may use wagers of 5, 7, and 9 points.
elseif ($question_num > 9 && $question_num <= 18){
    $low = 5;
    $med = 7;
    $high = 9;
}

//Remove the wager from available wagers and add the players' wagers to their scores if they got it right.
$sql = mysqli_query($conn, "SELECT * FROM players");
$i = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)) {
        $pid = $r['player_num'];
        $wager = 'wager' . $pid;
        $r_w = 'rightwrong' . $pid;
        if (isset($_POST[$wager])) {
            ${'wager' . $pid} = $_POST[$wager];
        }
        if (isset($_POST[$r_w])) {
            ${'rightwrong' . $pid} = $_POST[$wager];
        } else {
            ${'rightwrong' . $pid} = 0;
        }
        $i++;
    }
}

$query = mysqli_query($conn, "SELECT * FROM players");
$j = 1;
while ($j <= mysqli_num_rows($query) && $q = mysqli_fetch_array($query)) {
    $pid = $q['player_num'];
    $p_wager = ${'wager' . $pid};
    $p_pts = ${'rightwrong' . $pid};
    if ($p_wager == $low) {
        mysqli_query($conn, "UPDATE wagers SET low_wager = NULL where player_num = $pid");
    } elseif ($p_wager == $med) {
        mysqli_query($conn, "UPDATE wagers SET med_wager = NULL where player_num = $pid");
    } elseif ($p_wager == $high) {
        mysqli_query($conn, "UPDATE wagers SET high_wager = NULL where player_num = $pid");
    }
    $qst = 'question' . $question_num;
    mysqli_query($conn, "UPDATE scores SET `$qst` = $p_pts WHERE player_num = $pid");
    $p_score = 0;
    for($k=1;$k<=18;$k++){
        $pts = 'question' . $k;
        $chk = mysqli_query($conn, "SELECT `$pts` FROM scores WHERE player_num = $pid");
        $ch = mysqli_fetch_array($chk);
        if ($ch[$pts] == NULL){
            $ch[$pts] = 0; 
        }            
        $p_score = $p_score + $ch[$pts];
    }
    $chk_2 = mysqli_query($conn, "SELECT halftime, final FROM scores WHERE player_num = $pid");
    $chx = mysqli_fetch_array($chk_2);
    $p_score = $p_score + $chx['halftime'] + $chx['final'];
    // echo $pid . ": " . $p_score . $n;
    mysqli_query($conn, "UPDATE players SET pts = $p_score WHERE player_num = $pid");
    $j++;
}

//Which path are we going on next? If the next question is the first question of a new round, we need to check whether or not the 
//next question is in a new half.
$next_q = $question_num + 1;
$next_r = $_SESSION['id'] + 1;
if ($next_q % 3 == 1){
    if ($next_q == 10){
        $next = "halftime.php";
    }
    //The values of 19 and 20 are reserved for the halftime and final questions for the sake of consolidation of tables.
    //When the 18 standard questions have been asked we do a quick check-in on scores so players know what they can wager
    //for the final question.
    elseif ($next_q == 19 || $next_q == 20){
        $next = "scores.php";
    }
    else{
    //New round
        $next = "roundStart.php?id=" . $next_r;
    }
}
else {
    //New question, same round
    $next = "question.php?id=" . $next_q;
}

?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Next Question...</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>

<body>
    <div id="mainContent" align="center" style="margin-top:10%;">
<!-- Splash screen to prepare players for the next question. -->
        <h2 id="elipses">Next Question.</h2>
        <p><span id="counter" style="display:none;">5</span></p>
        <script type="text/javascript">
            function countdown() {
                var i = document.getElementById("counter");
                var x = document.getElementById("elipses");
                if (parseInt(i.innerHTML) <= 1) {
                    location.href = "<?php echo $next;?>";
                }
                i.innerHTML = parseInt(i.innerHTML) - 1;
                x.innerHTML = x.innerHTML + " .";
                
            }
            setInterval(function() {
                countdown();
            }, 1000);
        </script>
    </div>
</body>