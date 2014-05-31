<html>
  <?php
    require_once("header.php")
  ?>
  
  <body class="container">
    <h3>Tiny chat room</h3>
    
    <!-- page -->
    <div class="container" id="page-wrap">

      <?php
        if (isset($_SESSION['user'])) {
          $user = $_SESSION['user'];
          echo "<div id='name-area'>Welcome, <b id='user_name'>$user</b> <a href=# onclick='setName()';>(change)</a></div>";
        }
        else {
         echo "<div id='name-area'>Welcome</div>";
        }
      ?>
      
      <div id="chatbox"></div>
      <br/>
      <form id="message-area">
        <textarea id="sendie" maxlength = '200'></textarea>
        <button type="button" class="btn btn-primary" onclick="sendText()">Send</button>
      </form>
    </div>
    
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/main.js"></script>
    
  </body>
</html>