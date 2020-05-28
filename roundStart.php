<?php
include("variables.php");
session_start();
$n = "<br>";
$round_id = $_GET['id'];
$_SESSION['id'] = $round_id;
if($round_id <= 3){
    mysqli_query($conn, "UPDATE wagers SET low_wager = 2, med_wager = 4, high_wager = 6");
}
elseif($round_id > 3 && $round_id <= 6){
    mysqli_query($conn, "UPDATE wagers SET low_wager = 5, med_wager = 7, high_wager = 9");
}

?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet"> 
    <title>Trivia Round <?php echo $round_id;?></title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<body>
    <h1 style="margin-bottom:-10px;">Your Round <?php echo $round_id;?> Categories Are:</h1>
    <br>
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM questions WHERE round = $round_id");
    $i = 1;
    while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)){
        $category = $r['category'];
        $q_num = $r['question_num'];
        $query = mysqli_query($conn, "SELECT category FROM categories WHERE category_id = $category");
        $q = mysqli_fetch_array($query);
        ${'cat' . $q_num} = $q['category'];
    ?>
    <h2><?php echo ${'cat' . $q_num};?></h2>
    <?php
        $i++;
    } 
    $nextq = mysqli_query($conn, "SELECT * FROM questions WHERE round = $round_id ORDER BY question_num ASC");
    $x = mysqli_fetch_array($nextq);
    $nxt = $x['question_num'];
    ?>   
    <div>
        <button onclick="window.location.href='question.php?id=<?php echo $nxt;?>'">Start Round <?php echo $round_id;?></button>
    </div>
</body>