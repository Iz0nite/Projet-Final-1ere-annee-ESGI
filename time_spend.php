<?php
require('config.php');
session_start();
echo $_POST['time']."\n";


  $seconds = $_POST['time']%60;

 $minutes = floor($_POST['time']/60);

 $hours = floor($minutes/60);
 $minutes = $minutes%60;

// echo $seconds."\n";
// echo $minutes."\n";
// echo $hours."\n";

$time =  $hours.":".$minutes.":".$seconds;

if (isset($_SESSION['id'])){
  $query = 'INSERT INTO pass(user_id,post_id,time) VALUES(?,?,?)';
  $req= $bdd->prepare($query);
  $req->execute([
    $_SESSION['id'],
    $_POST['post_id'],
    $time

]);
}


 ?>
