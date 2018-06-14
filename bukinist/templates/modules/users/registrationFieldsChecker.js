$("#submitbutton").click(function () {
    if($("input[name='Password']").val()!=$("input[name='PasswordCheck']").val())
    {
        alert('confirm password is incorrect');
        return;
    }
    $(this).prop('disabled', true);
    $.ajax({ url: '/users/registration',
        data: {
            login: $("input[name='Username']").val(),
            password: $("input[name='Password']").val(),
            bday: $("input[name='Birthday']").val(),
            email: $("input[name='Email']").val()
        },
        type: 'post',
        success: function(output) {
            $("#submitbutton").prop('disabled', false);
            var res = JSON.parse(output);
            if(res.length!=0) {
                if (res.hasOwnProperty('login')) {
                    if (res['login'] == -1)
                        alert('login already used');
                }
                if (res.hasOwnProperty('email')) {
                    if (res['email'] == -1)
                        alert('email already used');
                }

            }
            else{
                ///redirect to login
                document.location.href="/users/login/1";
            }
        }
    });
});