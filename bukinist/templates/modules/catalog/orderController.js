$("button.addtocart").click(function () {
    //deleteCookie('order');

    if(getCookie('order')==undefined)
        var arr = [];
    else
        var arr = JSON.parse(getCookie('order'));
    console.log(arr);
    arr.push($("#bookid").val());
    setCookie('order',JSON.stringify(arr),100);
    if(arr.length==1)
        $("ul.navbar-nav.ml-auto").append($("<li class=\"nav-item\">\n" +
        "                    <a class=\"nav-link js-scroll-trigger\" href='/orders/cart'>Cart ( <span>1</span> )</a>\n" +
        "                </li>"));
    else{
        console.log();
        var t = +$($("ul.navbar-nav.ml-auto:last-child a span")[2]).text()+1;

        $($("ul.navbar-nav.ml-auto:last-child a span")[2]).text(t);
    }
});

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value+";path=/";

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}


function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
    setCookie   (name, "", {
        expires: -1
    })
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}


