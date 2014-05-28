<?php
$lines = file('chat.txt');
foreach ($lines as $line) {
  echo "<div>$line</div>";
}
?>