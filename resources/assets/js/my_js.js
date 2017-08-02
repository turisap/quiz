/**
 * Created by HP on 30-Jul-17.
 */
$(document).ready(function () {

    // fade away flash messages
    setTimeout(fadeFlashMessage, 3000);

    // like button ajax
    $('.like-quiz-btn').click(function (e) {

        var quiz_id = $(this).attr('data-content');
        e.preventDefault();

        $.ajax({
            url : '/quizzes/like',
            data : {
                quiz_id : quiz_id
            },
            type : "GET",
            success : function (data) {
                if(!data.error) {
                    makeQuizLiked(quiz_id);
                }
            },
            /*error : function (data) {
                console.log("Error", data);
            }*/
        })
    });


    // unlike button ajax
    $('.unlike-quiz-btn').click(function (e) {

        var quiz_id = $(this).attr('data-content');
        e.preventDefault();

        $.ajax({
            url : '/quizzes/unlike/' + quiz_id,
            data : {
                quiz_id : quiz_id
            },
            type : "GET",
            success : function (data) {
                if(!data.error) {
                    alert('hui');
                    /////makeQuizLiked(quiz_id);
                }
            },
            error : function (data) {
                console.log("Error", data);
             }
        })
    })
});

function makeQuizLiked(quiz_id){
    $('#' + quiz_id + '-like').remove();

    var parent = $('#row-'  + quiz_id);
    parent.append('<a href="" class="like-quiz-btn" data-content="'+ quiz_id + '" >UnLike</a>');
}



function fadeFlashMessage(){
    $('.flash_message').fadeOut(500);
}