<html>
  <head>
    <title>Chat room</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/main.css">
  </head>
  
  <body class="container">
    <h3>My tiny chat room :)</h3>
    <br/>
    
    <!-- page -->
    <div class="container" id="page-wrap">
      <div id="name-area">Welcome</div>
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