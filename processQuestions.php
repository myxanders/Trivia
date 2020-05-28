<?php
include("variables.php");
$n = "<br>";

$final_answers = [];
$queries = [];
$category1 = NULL;
$category2 = NULL;
$category3 = NULL;
$category4 = NULL;
$category5 = NULL;
$category6 = NULL;
$category7 = NULL;
$category8 = NULL;
$category9 = NULL;
$category10 = NULL;
$category11 = NULL;
$category12 = NULL;
$category13 = NULL;
$category14 = NULL;
$category15 = NULL;
$category16 = NULL;
$category17 = NULL;
$category18 = NULL;
$question1 = NULL;
$question2 = NULL;
$question3 = NULL;
$question4 = NULL;
$question5 = NULL;
$question6 = NULL;
$question7 = NULL;
$question8 = NULL;
$question9 = NULL;
$question10 = NULL;
$question11 = NULL;
$question12 = NULL;
$question13 = NULL;
$question14 = NULL;
$question15 = NULL;
$question16 = NULL;
$question17 = NULL;
$question18 = NULL;
$answer1 = NULL;
$answer2 = NULL;
$answer3 = NULL;
$answer4 = NULL;
$answer5 = NULL;
$answer6 = NULL;
$answer7 = NULL;
$answer8 = NULL;
$answer9 = NULL;
$answer10 = NULL;
$answer11 = NULL;
$answer12 = NULL;
$answer13 = NULL;
$answer14 = NULL;
$answer15 = NULL;
$answer16 = NULL;
$answer17 = NULL;
$answer18 = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category1'])) {
        $category1 = $_POST['category1'];
    }
    if (isset($_POST['question1'])) {
        $question1 = $_POST['question1'];
    }
    if (isset($_POST['answer1'])) {
        $answer1 = $_POST['answer1'];
    }
    if (isset($_POST['category2'])) {
        $category2 = $_POST['category2'];
    }
    if (isset($_POST['question2'])) {
        $question2 = $_POST['question2'];
    }
    if (isset($_POST['answer2'])) {
        $answer2 = $_POST['answer2'];
    }
    if (isset($_POST['category3'])) {
        $category3 = $_POST['category3'];
    }
    if (isset($_POST['question3'])) {
        $question3 = $_POST['question3'];
    }
    if (isset($_POST['answer3'])) {
        $answer3 = $_POST['answer3'];
    }
    if (isset($_POST['category4'])) {
        $category4 = $_POST['category4'];
    }
    if (isset($_POST['question4'])) {
        $question4 = $_POST['question4'];
    }
    if (isset($_POST['answer4'])) {
        $answer4 = $_POST['answer4'];
    }
    if (isset($_POST['category5'])) {
        $category5 = $_POST['category5'];
    }
    if (isset($_POST['question5'])) {
        $question5 = $_POST['question5'];
    }
    if (isset($_POST['answer5'])) {
        $answer5 = $_POST['answer5'];
    }
    if (isset($_POST['category6'])) {
        $category6 = $_POST['category6'];
    }
    if (isset($_POST['question6'])) {
        $question6 = $_POST['question6'];
    }
    if (isset($_POST['answer6'])) {
        $answer6 = $_POST['answer6'];
    }
    if (isset($_POST['category7'])) {
        $category7 = $_POST['category7'];
    }
    if (isset($_POST['question7'])) {
        $question7 = $_POST['question7'];
    }
    if (isset($_POST['answer7'])) {
        $answer7 = $_POST['answer7'];
    }
    if (isset($_POST['category8'])) {
        $category8 = $_POST['category8'];
    }
    if (isset($_POST['question8'])) {
        $question8 = $_POST['question8'];
    }
    if (isset($_POST['answer8'])) {
        $answer8 = $_POST['answer8'];
    }
    if (isset($_POST['category9'])) {
        $category9 = $_POST['category9'];
    }
    if (isset($_POST['question9'])) {
        $question9 = $_POST['question9'];
    }
    if (isset($_POST['answer9'])) {
        $answer9 = $_POST['answer9'];
    }
    if (isset($_POST['category10'])) {
        $category10 = $_POST['category10'];
    }
    if (isset($_POST['question10'])) {
        $question10 = $_POST['question10'];
    }
    if (isset($_POST['answer10'])) {
        $answer10 = $_POST['answer10'];
    }
    if (isset($_POST['category11'])) {
        $category11 = $_POST['category11'];
    }
    if (isset($_POST['question11'])) {
        $question11 = $_POST['question11'];
    }
    if (isset($_POST['answer11'])) {
        $answer11 = $_POST['answer11'];
    }
    if (isset($_POST['category12'])) {
        $category12 = $_POST['category12'];
    }
    if (isset($_POST['question12'])) {
        $question12 = $_POST['question12'];
    }
    if (isset($_POST['answer12'])) {
        $answer12 = $_POST['answer12'];
    }
    if (isset($_POST['category13'])) {
        $category13 = $_POST['category13'];
    }
    if (isset($_POST['question13'])) {
        $question13 = $_POST['question13'];
    }
    if (isset($_POST['answer13'])) {
        $answer13 = $_POST['answer13'];
    }
    if (isset($_POST['category14'])) {
        $category14 = $_POST['category14'];
    }
    if (isset($_POST['question14'])) {
        $question14 = $_POST['question14'];
    }
    if (isset($_POST['answer14'])) {
        $answer14 = $_POST['answer14'];
    }
    if (isset($_POST['category15'])) {
        $category15 = $_POST['category15'];
    }
    if (isset($_POST['question15'])) {
        $question15 = $_POST['question15'];
    }
    if (isset($_POST['answer15'])) {
        $answer15 = $_POST['answer15'];
    }
    if (isset($_POST['category16'])) {
        $category16 = $_POST['category16'];
    }
    if (isset($_POST['question16'])) {
        $question16 = $_POST['question16'];
    }
    if (isset($_POST['answer16'])) {
        $answer16 = $_POST['answer16'];
    }
    if (isset($_POST['category17'])) {
        $category17 = $_POST['category17'];
    }
    if (isset($_POST['question17'])) {
        $question17 = $_POST['question17'];
    }
    if (isset($_POST['answer17'])) {
        $answer17 = $_POST['answer17'];
    }
    if (isset($_POST['category18'])) {
        $category18 = $_POST['category18'];
    }
    if (isset($_POST['question18'])) {
        $question18 = $_POST['question18'];
    }
    if (isset($_POST['answer18'])) {
        $answer18 = $_POST['answer18'];
    }



    $sql = ("INSERT INTO questions (`question_num`, `round`, `category`, `question`, `answer`) VALUES ");
    $i = 1;
    $k = 0;
    while ($i <= 18) {
        $category = ${'category' . $i};
        $question = ${'question' . $i};
        $question = str_replace("'", "`", $question);
        $answer = ${'answer' . $i};
        $answer = str_replace("'", "`", $answer);
        if ($i % 3 == 1) {
            $k++;
        }
        $sql = $sql . "($i, $k, $category, '$question', '$answer')";
        if ($i < 18) {
            $sql = $sql . ",";
        }
        $i++;
    }

    echo $sql . $n;
    array_push($queries, $sql);

    if (isset($_POST['halftime_q'])) {
        $halftime_q = $_POST['halftime_q'];
    }
    $halftime_q = str_replace("'", "`", $halftime_q);
    $hq_sql = "INSERT INTO questions (`question_num`, `round`, `question`) VALUES (19, 7, '$halftime_q')";
    echo $hq_sql . $n;
    array_push($queries, $hq_sql);
    $half_sql = "INSERT INTO halftime_answers (`answers`) VALUES ";
    for ($j = 1; $j <= sizeof($_POST); $j++) {
        $half_a = "halftime_a" . $j;
        if (isset($_POST[$half_a])) {
            ${'halftime_a' . $j} = $_POST[$half_a];
        } else {
            break;
        }
        $half_ans = ${'halftime_a' . $j};
        $half_ans = str_replace("'", "`", $half_ans);
        $half_sql = $half_sql . "('$half_ans'),";
    }
    $half_sql = substr($half_sql, 0, -1);
    echo $half_sql . $n;
    array_push($queries, $half_sql);
    if (isset($_POST['final_q'])) {
        $final_q = $_POST['final_q'];
    }
    $final_sql = "INSERT INTO questions (`question_num`, `round`, `question`) VALUES (20, 8, 'Put the following numbers in order from smallest to largest, with 1 being the smallest and 4 being the largest:')";
    echo $final_sql . $n;
    array_push($queries, $final_sql);
    for ($j = 1; $j <= 4; $j++) {
        $ans = 'final_a' . $j;
        $val = 'final_v' . $j;
        if (isset($_POST[$ans])) {
            ${'final_a' . $j} = $_POST[$ans];
        }
        if (isset($_POST[$val])) {
            ${'final_v' . $j} = $_POST[$val];
        }

        $final_answers[${'final_v' . $j}] = ${'final_a' . $j};
    }

    ksort($final_answers);
    $m = 1;
    foreach ($final_answers as $x => $y) {
        echo $y . "($x)" . $n;
        $final_ans_sql = "UPDATE final_answers SET value = $x, description = '$y' WHERE rank = $m;";
        echo $final_ans_sql . $n;
        array_push($queries, $final_ans_sql);
        $m++;
    }
}

foreach ($queries as $z) {
    $query = mysqli_query($conn, $z);
    if (!$query) {
        echo "Error: " . mysqli_error($conn) . $n;
    }
}

header("location:index.php");
?>