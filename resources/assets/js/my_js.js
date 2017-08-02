/**
 * Created by HP on 30-Jul-17.
 */
$(document).ready(function () {

    // fade away flash messages
    setTimeout(fadeFlashMessage, 3000);

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
                    alert('success');
                }
            },
            error : function (data) {
                console.log("Error", data);
            }
        })
    })
});








function fadeFlashMessage(){
    $('.flash_message').fadeOut(500);
}