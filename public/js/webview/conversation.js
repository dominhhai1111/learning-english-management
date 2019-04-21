var isUpdate = false;
$(function () {
    setInterval(updateConversation, 1000);

    $('.btn-send').on('click', function() {
       sendConversation();
    });
});

function sendConversation() {
    updateConversation();
    var message = $('.message-input').val();
    $('.message-input').val('');

    $.ajax({
        type:'POST',
        url:'/api/user/send-conversation',
        data: {
            user_id: user['id'],
            chat_id: conversation['id'],
            content: message
        },
        success:function(result) {
            console.log(result);
        }
    });
}

function updateConversation() {
    isUpdate = true;
    $.ajax({
        type:'POST',
        url:'/api/user/update-conversation',
        data: {
            last_time: lastTime,
            chat_id: conversation['id'],
        },
        success:function(result) {
            isUpdate = false;
            if (result['hasNew']) {
                lastTime = result['last_time'];
                $.each(result['new_lines'], function(index, line){
                    addNewLine(line);
                });

            }
        }
    });
}

function addNewLine(line) {
    var html = "<div class='direct-chat-msg right'>"
            + "<div class='direct-chat-text' style='margin: 0 0 0 50px'>"
            + line['content']
            + "</div>"
            + "</div>";

    $('.direct-chat-messages').append(html);
}