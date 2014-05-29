<html>
  <body class="container">
  </body>
</html>

<?php
require_once('header.php');

// Flush log if selected
if (isset($_POST['delete'])) {
  $f = fopen('data/log.txt', 'w');
  fclose($f);
  header("Location: log.php");
}

// Load log data
$lines = file('data/log.txt');
echo "<p></p>";

foreach ($lines as $line) {
  echo "<div>$line</div>";
}

// Display delete button
if ($lines) {
  echo "<br/><form method='post' action='log.php'>
        <input type='text' style='display: none' name='delete' value='delete'/>
        <input type='submit' class='btn btn-danger' value='Delete log'/>
        </form>";
  
}
else {
  echo "<h3>Oops, log is empty :/</h3>";
}

?>