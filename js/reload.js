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
                response = jQuery.parseJSON(response);
                if(response != false) {
                    $("#chat-mes").append('<h2 id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
                }
        });
    } else {
        $.post('../php/send.php?action=getMessage&latestId=0', function(response){
            response = jQuery.parseJSON(response);
            if(response != false) {
                $("#chat-mes").append('<h2 id="'+response[1]+'">'+response[0] + ' von: ' + response[2]+'</h2>');
            }
        });
    }
}