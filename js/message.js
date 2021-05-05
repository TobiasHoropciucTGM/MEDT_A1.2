$('#messageArea').keyup(function(e) {
   if(e.which == 13) {
        message = document.getElementById('messageArea').value;
        document.getElementById('messageArea').value = "";
        $.post('../php/send.php?action=sendMessage&message='+message, function(response){
            
        });
   }
    
});

