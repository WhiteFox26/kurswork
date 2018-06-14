var offset = 0;
var commentsN = 5;
var bookid;
window.onload = function () {
    bookid = $("#bookid").val();
    $("#getMoreComments").click(getComments);
    getComments();
};

$("#sendComment").click(function (ev) {
    ev.preventDefault();
    var userLogin = $("#userlogin").text();
    var d = new Date();
    var options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric'
    };
    var datetime = d.toLocaleString('uk', options).replace(',', '');
    var content = $("textarea").val();
    if (content == '')
        return;



    var $comment = $("<div>\n" +

        "                        <p>"+content+"</p>\n" +
        "                        <small class=\"text-muted\">Posted by "+userLogin+" on "+datetime+"</small>\n" +
        "                        <hr>\n" +
        "                    </div>");

    $("#comment-container div.form-group").parent().parent().append($comment);


    $comment.fadeIn('slow');
    $.ajax({
        url: '/comments/addComment',
        data: {
            id: bookid,
            userLogin: userLogin,
            datetime: datetime,
            content: content
        },
        type: 'POST',
        success: function (res) {
            console.log( res);
            //console.log( JSON.parse(res));
        }
    });
});

function getComments() {
    $.ajax({ url: '/comments/getCommentsToFilm',
        data: {
            id: bookid,
            offset: offset,
            commentsN: commentsN
        },
        type: 'POST',
        success: function(res) {
            var arr = JSON.parse(res);
            console.log(arr);
            offset+= commentsN;
            for(var i=0;i<arr.length;i++){


                var $comment = $("<div>\n" +
                    "                        <p>"+arr[i]['content']+"</p>\n" +
                    "                        <small class=\"text-muted\">Posted by "+arr[i]['login']+" on "+arr[i]['datetime']+"</small>\n" +
                    "                        <hr>\n" +
                    "                    </div>");
                $comment.insertBefore($("#getMoreComments"));

                $comment.fadeIn('slow');
            }

        }
    });
}