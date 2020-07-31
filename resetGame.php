<?php
include("variables.php");
$n = "<br>";
$request = $_GET['req'];
if (isset($_POST['category'])){
    $category = $_POST['category'];
    $unique = true;
    $category = ucwords(str_replace(" and ", " & ", $category));
    $sql = mysqli_query($conn, "SELECT category FROM categories");
    $query = mysqli_query($conn, "SELECT MAX(category_id) AS max FROM categories");
    $q = mysqli_fetch_array($query);
    $max = $q['max'];
    $newCatID = $max + 1;
    $i = 1;
    while ($i <= mysqli_num_rows($sql) && $r = mysqli_fetch_array($sql)){
        $cat = $r['category'];
        if ($category == $cat || strtoupper($category) == $cat){
            // echo '<body style="background-image: linear-gradient(navy,royalblue); background-repeat: no-repeat; background-attachment: fixed; height: 100%; margin: 0;"><h2 align="center" style="color: white; margin-top:100px; font-size: 48px; font-family: Istok Web, sans-serif">Category already exists.</h2></body>';
            // header('Refresh:2 ; URL=index.php');
            $unique = false;
            header("location:index.php?cat=failed");
        }
        $i++;
    }
}

function resetGame($conn){
// Create a blank slate for a new game of trivia.
    mysqli_query($conn, "DELETE FROM halftime_answers");
    mysqli_query($conn, "DELETE FROM questions");
    mysqli_query($conn, "DELETE FROM scores");
    mysqli_query($conn, "DELETE FROM wagers");
    mysqli_query($conn, "DELETE FROM players");
    mysqli_query($conn, "UPDATE final_answers SET description = NULL, value = NULL");

    header("location:index.php");
}

function newGame($conn){
// Create a new game with the same questions.
    mysqli_query($conn, "DELETE FROM scores");
    mysqli_query($conn, "DELETE FROM wagers");
    mysqli_query($conn, "DELETE FROM players");

    header("location:index.php");
}

function newCategory($conn, $id, $newCat){
    mysqli_query($conn, "INSERT INTO categories (`category_id`,`category`) VALUES ($id, '$newCat')");
    header("location:index.php?cat=success");
}

if ($request == "reset"){
    resetGame($conn);
}
elseif($request == "newgame"){
    newGame($conn);
}
elseif($request = "category" && $unique == true){
    newCategory($conn, $newCatID, $category);
}
?>