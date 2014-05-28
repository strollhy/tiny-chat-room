<?php
header('Content-Type: text/html; charset=utf-8');

$lines = file('chat.txt');
foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>