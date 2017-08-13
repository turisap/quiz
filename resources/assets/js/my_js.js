/**
 * Created by HP on 30-Jul-17.
 */
$(document).ready(function () {

    // fade away flash messages
    setTimeout(fadeFlashMessage, 3000);
});
    // like button ajax
    $('body').on('click','.like-quiz-btn', function (e) {

        var quiz_id = $(this).attr('data-content');
        e.preventDefault();

        $.ajax({
            url : '/quizzes/like/' + quiz_id,
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
    $('body').on('click', '.unlike-quiz-btn', function (e) {

        var quiz_id = $(this).attr('data-content');
        e.preventDefault();

        $.ajax({
            url : '/quizzes/unlike/' + quiz_id,
            type : "GET",
            success : function (data) {
                if(!data.error) {
                    makeQuizUnliked(quiz_id);
                }
            },
            /*error : function (data) {
                console.log("Error", data);
             }*/
        })
    });


function makeQuizLiked(quiz_id){
    $('#' + quiz_id + '-like').remove();

    var parent = $('#row-'  + quiz_id);
    parent.append('<a href="#"  class="unlike-quiz-btn"  id="' + quiz_id + '-unlike" data-content="'+ quiz_id +'" ></a>');
}

function makeQuizUnliked(quiz_id){
    $('#' + quiz_id + '-unlike').remove();
    var parent = $('#row-'  + quiz_id);
    parent.append('<a href="#" class="like-quiz-btn"  id="' + quiz_id + '-like" data-content="'+ quiz_id + '" ></a>');
}



function fadeFlashMessage(){
    $('.flash_message').fadeOut(500);
}