var busy = false;
var file = "chat.txt";

function Chat() {
  this.update = updateChat;
  this.send = sendChat;
  this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat() {
  if(!busy){
    busy = true;
    $.ajax({
      type: "POST",
      url: "process.php",
      data: {'function': 'getState', 'file': file},
      dataType: "json",	
      success: function(data) {state = data.state; busy = false;}
    });
  }	
}

//update the chat
function updateChat() {
  if (!busy) {
    busy = true;
    $.ajax({
      type: "POST",
      url: "process.php",
      data: {'function': 'update', 'state': state, 'file': file},
      dataType: 'json',
      success: function(data) {
        if (data.text) {
          for (var i = 0; i < data.text.length; i++) {
            $('#chatbox').append("<div>" + data.text[i] + "</div>");
          }
        
          document.getElementById('chatbox').scrollTop = document.getElementById('chatbox').scrollHeight;
        }
        busy = false;
        state = data.state;
      }
    });
  }
  else {
    //setTimeout(updateChat, 1500);
  }
}


//send the message
function sendChat(message, nickname) { 
	//updateChat();
	$.ajax({
		type: "POST",
		url: "process.php",
		data: {'function': 'send','message': message,'nickname': nickname,'file': file},
		dataType: "json",
		success: function(data){
			updateChat();
		}
	});
}


// kick off chat
var chat = new Chat();
var name = "";


// send text  
function sendText() {
  var area = $('#sendie');
  var text = area.val();
  var maxLength = area.attr("maxlength");  
  var length = text.length; 

  // send 
  if (length <= maxLength + 1) { 
    chat.send(text, name);  
    area.val("");
  }
  else {
    area.val(text.substring(0, maxLength));
  }  
}


window.onload = function() {
  // ask user for name with popup prompt    
  name = prompt("Enter your chat name:", "Guest");

  // default name is 'Guest'
  if (!name || name === ' ') {
    name = "Guest";  
  }
  $('#name-area').html('Welcome, <b>' + name + '</b>');

  // set update interval
  setInterval(chat.update, 1000);

  $(function() {
    chat.getState(); 

    // watch textarea for key presses
    $("#sendie").keydown(function(event) {  
      var key = event.which;  

      //all keys including return.  
      if (key >= 33) {
         var maxLength = $(this).attr("maxlength");  
         var length = this.value.length;  

         // don't allow new content if length is maxed out
         if (length >= maxLength) {  
             event.preventDefault();  
         }  
      }  
    });

    // watch textarea for release of key press
    $('#sendie').keyup(function(e) {  
      if (e.keyCode == 13) { 
        var text = $(this).val();
        var maxLength = $(this).attr("maxlength");  
        var length = text.length; 

        // send 
        if (length <= maxLength + 1) { 
          chat.send(text, name);  
          $(this).val("");
        }
        else {
          $(this).val(text.substring(0, maxLength));
        }  
      }
   });
  });
}

