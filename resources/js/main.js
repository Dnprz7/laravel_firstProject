var url = 'http://127.0.0.1:8000';
window.addEventListener("load", function(){

    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', 'img/hearts-64(1).png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
						console.log('You like the post');
					}else{
						console.log('Error on like');
					}
				}
            });

            dislike();
        });
    }
    like();


    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', 'img/favorite-3-64.png');
            like();
        });
    }
    dislike();

});
