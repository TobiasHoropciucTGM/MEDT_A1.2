setInterval(reload, 100);


function reload() { 
    items = document.getElementById('chat-mes').childNodes;
    console.log(items.length);
    arr = [];
    if(items.length > 1) {
        for(i = 0; i < items.length; i++) {
            if(items[i].nodeName == "H2") {
                arr.push(items[i]);
            }
        }
        id = arr[arr.length-1].id;
    } else {
        id = 0;
    }
    
    
    $.post('../php/send.php?action=getMessage&latestId='+id, function(response){
        response = jQuery.parseJSON(response);
        
        console.log(response);    
        if(response[0].length != 0) {
                
                for(i = 0; i < response[0].length; i++) {
                    
                    if(response != false) {
                        if(response[1] == response[0][i][2]) {
                            $("#chat-mes").append('<h2 style="text-align: right;margin-bottom:0" id="'+response[0][i][1]+'">'+response[0][i][0]+'</h2>');
                            $("#chat-mes").append('<h4 style="text-align: right;margin-top:0;" class="usern">'+response[0][i][2]+'</h4>');
                        } else {
                            $("#chat-mes").append('<h2 style="text-align: left;margin-bottom:0; class="usern" id="'+response[0][i][1]+'">'+response[0][i][0]+'</h2>');
                            $("#chat-mes").append('<h4 style="text-align: left;margin-top:0;" class="usern">'+response[0][i][2]+'</h4>');
                        }
                        var messageBody = document.querySelector('#chat-mes');
                        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                    }       
                }
            }
    });
}