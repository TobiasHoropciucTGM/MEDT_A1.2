setInterval(reload, 100);


function reload() { 
    items = document.getElementById('chat-mes').childNodes;
    arr = [];
    if(items.length > 1) {
        for(i = 0; i < items.length; i++) {
            if(items[i].nodeName == "H2") {
                arr.push(items[i]);
            }
        }
        
        id = arr[arr.length-1].id;
        
        $.post('../php/send.php?action=getMessage&latestId='+id, function(response){
                
                if(response[0].length != 0) {
                    response = jQuery.parseJSON(response);
                    for(i = 0; i < response[0].length; i++) {
                        
                        if(response != false) {
                            if(response[1] == response[0][i][2]) {
                                $("#chat-mes").append('<h2 style="text-align: right" id="'+response[0][i][1]+'">'+response[0][i][0] + ' von: ' + response[0][i][2]+'</h2>');
                            } else {
                                $("#chat-mes").append('<h2 style="text-align: left" id="'+response[0][i][1]+'">'+response[0][i][0] + ' von: ' + response[0][i][2]+'</h2>');
                            }
                            var messageBody = document.querySelector('#chat-mes');
                            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                        }       
                    }
                    //console.log(response);
                    /*if(response != false) {
                        if(response[3] == response[2]) {
                            $("#chat-mes").append('<h2 style="text-align: right" id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                        } else {
                            $("#chat-mes").append('<h2 style="text-align: left" id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                        }
                        var messageBody = document.querySelector('#chat-mes');
                        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                    }*/
                }
                /*  
                response = jQuery.parseJSON(response);
                //console.log(response);
                if(response != false) {
                    if(response[3] == response[2]) {
                        $("#chat-mes").append('<h2 style="text-align: right" id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                    } else {
                        $("#chat-mes").append('<h2 style="text-align: left" id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                    }
                    var messageBody = document.querySelector('#chat-mes');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                }*/
        });
    } /*else {
        $.post('../php/send.php?action=getMessage&latestId=0', function(response){
            response = jQuery.parseJSON(response);
            if(response != false) {
                if(response[3]==response[2]) {
                    $("#chat-mes").append('<h2 style="text-align: right" id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                } else {
                    $("#chat-mes").append('<h2 style="text-align: left" id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                }
                var messageBody = document.querySelector('#chat-mes');
                messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
            }
        });
    }*/
}