<?php
session_start();
$post_function = $_POST['function'];
$log = array();

switch($post_function) {

    case('setUser'):
        $_SESSION['user'] = $_POST['user'];
        break;

/*    case('getState'):
        if (file_exists('data/log.txt')) {
            $lines = file('data/log.txt');
        }
        $log['state'] = $_SESSION['state'] = count($lines); 
        break;  */

    // update chat messages
    case('update'):
        if (file_exists('data/log.txt')) {
            $lines = file('data/log.txt');
        }
        $count =  count($lines);
        $state = $_SESSION['state'];

        if ($state == $count){
              $log['state'] = $state;
              $log['text'] = false;
        } else {
              $text= array();
              $log['state'] = $state + count($lines) - $state;
              foreach ($lines as $line_num => $line) {
                 if ($line_num >= $state){
                     $text[] =  $line = str_replace("\n", "", $line);
                 }
              }
              $log['text'] = $text; 
              $_SESSION['state'] = $count;
        }
        break;

    case('send'):
        $nickname = htmlentities(strip_tags($_POST['nickname']));
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        $message = htmlentities(strip_tags($_POST['message']));
        if (($message) != "\n") {
            if (preg_match($reg_exUrl, $message, $url)) {
                $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
            } 
            fwrite(fopen('data/log.txt', 'a'), "<b>". $nickname . "</b>: " . $message = str_replace("\n", " ", $message) . "\n"); 
        }
        break;
}
echo json_encode($log);
?>