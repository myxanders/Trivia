<?php
include("variables.php");
$n = "<br>";
$sp = "&nbsp";
$tab = $sp . $sp . $sp . $sp;

// mysqli_query($conn, "DELETE FROM questions");
// mysqli_query($conn, "DELETE FROM halftime_answers");
// mysqli_query($conn, "UPDATE final_answers SET value = NULL, description = NULL");

?>
<html>

<head>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Cambo' rel='stylesheet'>
    <title>Trivia Night</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<script>
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
                <th style="width: 300px;">Description</th>
                <th style="width: 100px;">Value</th>
            </tr>
            <tr id="answer1" style="display:none;">
                <td>1</td>
                <td>Mitchell</td>
                <td>1</td>
            </tr>
            <tr id="answer2" style="display:none;">
                <td>2</td>
                <td>Travis</td>
                <td>4</td>
            </tr>
            <tr id="answer3" style="display:none;">
                <td>3</td>
                <td>Jordan</td>
                <td>8</td>
            </tr>
            <tr id="answer4" style="display:none;">
                <td>4</td>
                <td>John</td>
                <td>13</td>
            </tr>
        </table>
    </div>
</body>

</html>