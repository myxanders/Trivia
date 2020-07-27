<?php
include("variables.php");
$n = "<br>";

//If player got the final question right, add their wager. If they got it wrong, deduct it.

$sql = mysqli_query($conn, "SELECT * FROM players");
$i = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)) {
        $pid = $r['player_num'];
        $r_w = 'rightwrong' . $pid;
        $delta = mysqli_query($conn, "SELECT final FROM scores WHERE player_num = $pid");
        $d = mysqli_fetch_array($delta);
        $final_bet = $d['final'];
        
        if (isset($_POST[$r_w])) {
            ${'final_bet' . $pid} = abs($final_bet);
        } else {
            ${'final_bet' . $pid} = 0 - abs($final_bet);
        }
        // echo ${'final_bet' . $pid} . $n;
        $i++;
    }
}

$query = mysqli_query($conn, "SELECT * FROM players");
$j = 1;
while ($j <= mysqli_num_rows($query) && $q = mysqli_fetch_array($query)) {
    $pid = $q['player_num'];
    $p_pts = ${'final_bet' . $pid};
    mysqli_query($conn, "UPDATE scores SET final = $p_pts WHERE player_num = $pid");
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

//A session id value of 7, i.e. round 7, indicates the game is through asking standard questions.
//"Round 7" also affects presentation of the leaderboard.
$_SESSION['id'] = 7;
$next = "scores.php";

?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Tallying points...</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>

<body>
    <div id="mainContent" align="center" style="margin-top:10%;">
<!-- Splash screen to build the suspense of final scores. -->
        <h2 id="elipses">Tallying points.</h2>
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