var genres = [];
var amount = 3;
var offset = 0;
var isloading = false;
var selectedGenre ='';

window.onload = function () {

    $("a.genre").each(function () {
        genres.push($(this).text());
    });
    selectedGenre = $("a.genre:first-child").attr('data-genre');
    console.log(selectedGenre);
    loadBooks();
};


function loadBooks(genreChanged) {

    isloading = true;
    $.ajax({ url: '/catalog/getBooks',
        data: {
            offset: offset,
            amount: amount,
            genre: selectedGenre
        },
        type: 'post',
        success: function(output) {

            if(genreChanged!=undefined && genreChanged==true)
                $("#items div.row").empty();

            var arr = JSON.parse(output);
            console.log(arr);
            offset+=arr.length;
            if(arr.length==0)
                $("#loadmore").attr('disabled',true);


            $(arr).each(function () {
                console.log(this);
                var rating = $("<div id='"+this['id']+"'></div>");
                for(var i=0;i<5;i++){
                    if(i<this['avgMark'])
                        rating.append($("<span class=\"fa fa-star checked\"></span>"));
                    else
                        rating.append($("<span class=\"fa fa-star fa\"></span>"));
                }

                var $item = $('<a href="/catalog/view/'+this['id']+'"><div class="col-lg-4 col-md-6 mb-4">\n' +
                   '                    <div class="card h-100">\n'+
                   '                        <img class="card-img-top" style="" src="/uploads/books/'+this['imageid']+'" alt="">\n' +
                   '                        <div class="card-body">\n' +
                   '                            <h4 class="card-title">\n' +
                   '                                <a href="/catalog/view/'+this['id']+'">'+this['name']+'</a>\n' +
                   '                            </h4>\n' +
                   '                            <h5>'+this['author']+'</h5>\n' +
                   '                            <h5>'+this['price']+' грн</h5>\n' +
                   '                        </div>\n' +
                   '                        <div class="card-footer">\n' +

                   '                        </div>\n' +
                   '                    </div>\n' +
                   '                </div></a>');
                $("div.card-footer",$item).append(rating);
               $("#items div.row").append($item);

            });
        }
    });
}

$("#loadmore").click(loadBooks);


$("a.genre").click(function (ev) {
    offset=0;
   $("a.genre").removeClass('selected');
   $(this).addClass('selected');
   selectedGenre = $("a.genre.selected").attr('data-genre');
   console.log(selectedGenre);

   loadBooks(true);

    $("#loadmore").attr('disabled',false);
});


