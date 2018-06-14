$("span.fa.fa-star").hover(function () {

    var indexOflast = $(this).index();
    $("span.fa.fa-star",$(this).parent()).each(function () {
        $(this).removeClass('checked');
        if($(this).index()<=indexOflast)
        {
            $(this).addClass('checked');
        }
    });
});

$("span.fa.fa-star").parent().mouseout(function () {

    $("span.fa.fa-star",$(this).parent()).each(function () {
        if($(this).index()<=$(".bookmark",$(this).parent()).val())
        {
            $(this).addClass('checked');
        }
        else{
            $(this).removeClass('checked');
        }

    });
});
var context;

$("span.fa.fa-star").click(function () {
    var id = $(this).parent().attr('id');
    context = this;
    var mark = $(this).index();
    $.ajax({
        url: '/rating/setRating',
        data: {
            id: id,
            userLogin: $("#userlogin").text(),
            mark: mark
        },
        type: 'POST',
        success: function (res) {
            $.ajax({
                url: '/rating/getRating',
                data: {
                    id: id,
                    userLogin: $("#userlogin").text()
                },
                type: 'POST',
                success: function (res) {

                    var newavg = Math.round(JSON.parse( res)['avgMark']);
                    $(".bookmark",$(context).parent()).val(newavg);

                    $("span:nth-last-child(2)",$(context).parent()).text('Середня оцінка: '+Math.round(JSON.parse( res)['avgMark']));
                    $("span:last-child",$(context).parent()).text('Ваша оцінка: '+JSON.parse( res)['userRating']);
                    $("span.fa.fa-star",$(context).parent()).each(function () {
                        $(this).removeClass('checked');
                        if($(this).index()<=newavg)
                        {
                            $(this).addClass('checked');
                        }
                    });

                }
            });

        }
    });
});
/* $("span.fa.fa-star",$(this).parent()).each(function () {
                $(this).removeClass('checked');
                if($(this).index()<=)
                {
                    $(this).addClass('checked');
                }
            });*/