<?php
include("variables.php");
$n = "<br>"; //testing changes
?>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet">  
    <title>Add Trivia Questions</title>
    <link rel="stylesheet" type="text/css" href="triviaStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="favicon2.ico">
</head>
<script>
// This function is necessary for adding new answers to the halftime question, which has at least four correct responses.
    function newAnswer() {
        var table = document.getElementById("half");
        var ans = table.rows[1].cells[0].innerHTML;
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var ans_num = parseInt(ans.slice(-1));
        var new_ans = ans_num + 1;
        cell1.innerHTML = "Answer #" + new_ans;
        cell2.innerHTML = "<input type='text' name = halftime_a" + new_ans + " style='width: 350px;'>";
    }
</script>
<body>
    <div>
        <h2>Add Questions</h2>
        <form action="processQuestions.php" method="post">
            <table id="table">
                <tr>
                    <th sytle="width: 100px;">Round</th>
                    <th sytle="width: 100px;">No.</th>
                    <th sytle="width: 200px;">Category</th>
                    <th style="width: 350px;">Question</th>
                    <th style="width: 250px;">Answer</th>
                </tr>
                <?php
                $i = 1;
                $k = 0;
                //There are 18 standard questions, so there needs to be 18 entries for questions and answers.
                while ($i <= 18) {
                    if ($i % 3 == 1) {
                        $k = $k + 1;
                    }
                ?>
                    <tr>
                        <td><?php echo $k;?></td>
                        <td><?php echo $i;?></td>
                        <td>
                            <select style="width: 175px;" name="<?php echo 'category' . $i; ?>">
                                <option value="" disabled selected></option>
                                <?php
                                $opts = mysqli_query($conn, "SELECT * FROM categories ORDER BY category ASC");
                                $nums = mysqli_num_rows($opts);
                                $j = 1;
                                while ($j <= $nums && $r = mysqli_fetch_array($opts)) {
                                    $cid = $r['category_id'];
                                    $cat = $r['category'];
                                    echo "<option value=" . $cid . ">" . $cat . "</option>";
                                    $j++;
                                }
                                ?>
                            </select></td>
                        <td><input type="text" name="question<?php echo $i; ?>" style="width: 300px;"></td>
                        <td><input type="text" name="answer<?php echo $i; ?>" style="width: 200px;"></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
            <br>
            <div>
                <h2>Halftime Question</h2>
            <table id="half">
                <tr>
                    <th style="width: 150;">Question</th>
                    <th style="width: 400px;">
                        <input type="text" name="halftime_q" style="width: 350px;">
                    </th>
                </tr>
                <tr>
                    <td>Answer #1</td>
                    <td><input type="text" name="halftime_a1" style="width: 350px;"></td>
                </tr>
            </table>
            </div>
            <br>
            <div id="buttons">
                <button align="center" type="button" onclick="newAnswer()">Add Answer</button>
            </div>
            <br>
            <div>
            <!-- The final question requires putting values in order from least to greatest. The user must enter a 
                 description and the value associated with it. -->
                <h2>Final Question</h2>
            <table id="final">
                <tr>
                    <th style="width: 150;">Question</th>
                    <th style="width: 400px;">Answers</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Answer #1</td>
                    <td><input type="text" name="final_a1" style="width: 350px;"></td>
                    <td><input type="number" name="final_v1" style="width: 150px;"></td>
                </tr>
                <tr>
                    <td>Answer #2</td>
                    <td><input type="text" name="final_a2" style="width: 350px;"></td>
                    <td><input type="number" name="final_v2" style="width: 150px;"></td>
                </tr>
                <tr>
                    <td>Answer #3</td>
                    <td><input type="text" name="final_a3" style="width: 350px;"></td>
                    <td><input type="number" name="final_v3" style="width: 150px;"></td>
                </tr>
                <tr>
                    <td>Answer #4</td>
                    <td><input type="text" name="final_a4" style="width: 350px;"></td>
                    <td><input type="number" name="final_v4" style="width: 150px;"></td>
                </tr>
            </table>
            </div> 
            <br>           
            <div>
                <button align="center" type="submit">Submit Questions</button>
            </div>
        </form>
    </div>
</body>