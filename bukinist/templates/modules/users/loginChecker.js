
$("#loginButton").click(function () {
    $.ajax({ url: '/users/login',
        data: {
            login: $("input[name='Username']").val(),
            password: $("input[name='Password']").val()
        },
        type: 'post',
        success: function(output) {
            console.log(output);
            if(output==-1) {
                alert('wrong login or password');
            }
            else{
                ///redirect to login
                document.location.href="/";
            }
        }
    });
});