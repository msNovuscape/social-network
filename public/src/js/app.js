var postId = 0;
var postBodyElement = null;
$('.posts').find('.interaction').find('.edit').on('click',function (event) {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];

    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click',function () {
    $.ajax({
       method:'Post',
       url : editUrl,
       dataType:'json',
       data:{id: postId,body:$('#post-body').val(),_token:token},
        success:function(response){
            $(postBodyElement).text(response.body);
            $('#edit-modal').modal('hide');
/*
            $('.success').text(response.msg);
*/

        },
        error:function (response) {
            if (response.responseJSON.validationErrors){
                var txt = "";
                response.responseJSON.validationErrors.forEach(function(value){
                    txt = txt + value;
                });
                alert(txt);
            }
        },
    });
});

$('.like').on('click',function (event) {
    event.preventDefault();
    var isLike = event.target.previousElementSibling == null ;
    postId = event.target.parentNode.parentNode.dataset['postid'];

    $.ajax({
        method: 'Post',
        url:likeUrl,
        data:{ postId:postId, isLike:isLike, _token : token},
        success:function () {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You liked this post' :'Like':event.target.innerText == 'Dislike' ? 'You disliked this post' : 'Dislike';
            if(isLike){

                if (event.target.innerText == 'You liked this post'){
                    event.target.nextElementSibling.innerText = event.target.nextElementSibling.textContent == '' ?  1 :++event.target.nextElementSibling.textContent ;
                    event.target.nextElementSibling.nextElementSibling.nextElementSibling.innerText = event.target.nextElementSibling.nextElementSibling.textContent == 'Dislike' ? event.target.nextElementSibling.nextElementSibling.nextElementSibling.textContent : event.target.nextElementSibling.nextElementSibling.nextElementSibling.textContent == '1' ? '' : --event.target.nextElementSibling.nextElementSibling.nextElementSibling.textContent  ;
                }
                else{
                    event.target.nextElementSibling.innerText = event.target.nextElementSibling.textContent == '1' ?  '' :--event.target.nextElementSibling.textContent ;

                    }
                event.target.nextElementSibling.nextElementSibling.innerText = 'Dislike';

            }else{

                if (event.target.innerText == 'You disliked this post'){
                    event.target.nextElementSibling.innerText = event.target.nextElementSibling.textContent == '' ?  1 :++event.target.nextElementSibling.textContent ;
                    event.target.previousElementSibling.innerText = event.target.previousElementSibling.previousElementSibling.textContent == 'Like' ? event.target.previousElementSibling.textContent : event.target.previousElementSibling.textContent == '1' ? '' : --event.target.previousElementSibling.textContent ;

                }else{
                    event.target.nextElementSibling.innerText = event.target.nextElementSibling.textContent == '1' ?  '' :--event.target.nextElementSibling.textContent ;

                }
                event.target.previousElementSibling.previousElementSibling.innerText = 'Like';

            }
        }

    });
});

$('.badge').on('click',function (event) {

    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLiked = $(this).attr('id') == 'likeNumber';
    $(this).prop('disabled',true);

    $.ajax({
        method: 'Post',
        url: likePeopleUrl,
        data: {postId: postId, isLike: isLiked, _token: token},
        success: function (response) {
            console.log(response.user);
            var txt = "";
            response.user.forEach(function(value){
                txt = txt + '<ul>' + value + '</ul>';
            });
            console.log(txt);
            $('#like-user').text(null);
            $('#like-user').append(txt);
            $('#likeModal').modal();
            $(this).prop('disabled',false);

        }
    });

});

$('#sign-up').on('click',function (event) {
        event.preventDefault();
        $('.signin').hide();
        $('.signup').show();
        $('.navbar-right').append('<li><a id="log-in" href="">SignIn</a>');
        $('#log-in').on('click',function (event) {

            event.preventDefault();
            $('.signup').hide();
            $('.signin').show();
            $('.navbar-right').text(null);

        });

});


