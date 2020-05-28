<?php
include("variables.php");
$n = "<br>";
mysqli_query($conn, "DELETE FROM halftime_answers");
mysqli_query($conn, "DELETE FROM questions");
mysqli_query($conn, "DELETE FROM scores");
mysqli_query($conn, "DELETE FROM wagers");
mysqli_query($conn, "DELETE FROM players");
mysqli_query($conn, "UPDATE final_answers SET description = NULL, value = NULL");

header("location:index.php");
?>