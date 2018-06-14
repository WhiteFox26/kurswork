var id;

$("select").change(function () {
    id=this.value;
    $("input[name='id']").val(id);
    console.log(id);
    loadSelectedBook();
});

window.onload = function () {
    id=$("select[name='bookslist'] option:first-child").val();

    $("input[name='id']").val(id    );
    loadSelectedBook();
};

$("input[name='searchfield']").focusout(function () {
    var searchString = $(this).val();
    console.log(searchString);
    $("select[name='bookslist'] option").each(function () {
        $(this).removeAttr('selected');
        if($(this).text().toLowerCase().indexOf(searchString.toLowerCase()) >= 0)
        {
            $(this).attr('selected',true);
            id = $(this).val();
        }
    });

    loadSelectedBook();
});

function loadSelectedBook() {
    $.ajax({
        url: '/catalog/getBook',
        data: {
            id:id
        },
        type: 'post',
        success: function (res) {
            var book = JSON.parse(res);
            console.log(book);

            $("input[name='genres']").val(book['genre']);
            console.log($("input[name='id']").val());
            $("input[name='id']").val(book['id']);


            $("input[name='author']").val(book['author']);
            var t = 'http://'+document.location.host+'/uploads/books/'+book['imageId'];
            $('img').attr('src',t);
            console.log(t);
            $("input[name='age']").val(book['age']);
            $("textarea[name='description']").val(book['description']);
            $("input[name='language']").val(book['language']);
            $("input[name='name']").val(book['name']);
            $("input[name='pages']").val(book['pages']);
            $("input[name='year']").val(book['year']);
            $("input[name='price']").val(book['price']);
            $("input[name='amount']").val(book['amount']);
        }
    })
}


