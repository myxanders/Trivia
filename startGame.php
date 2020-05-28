<?php
include("variables.php");
$n = "<br>";

$total_players = sizeof($_POST);
$i=1;
$sql = "INSERT INTO players (`player_name`) VALUES";
while ($i <= $total_players){
    $pl = 'player' . $i;
    ${'player' . $i} = $_POST[$pl];
    echo ${'player' . $i} . $n;
    $sql = $sql . " ('" . ${'player' . $i} . "')";
    if ($i != $total_players){
        $sql = $sql . ", ";
    }
    $i++;
}
mysqli_query($conn, $sql);
mysqli_query($conn, "INSERT INTO wagers (`player_num`) SELECT player_num FROM players");
mysqli_query($conn, "INSERT INTO scores (`player_num`) SELECT player_num FROM players");

header("location:roundStart.php?id=1");

?>