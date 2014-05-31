<?php
// start session to remember user name
session_start();
session_regenerate_id(true);

header('Content-Type: text/html; charset=utf-8');

echo <<< _HEAD
    <head>
      <title>Tiny chat room</title>
      <link type='text/css' rel='stylesheet' href='css/bootstrap.css'>
      <link type='text/css' rel='stylesheet' href='css/main.css'>
  
      <a href="index.php">Home</a>
      |
      <a href="log.php">History</a>
      |
      <a href="logout.php">Log out</a>
    </head>
_HEAD;
?>