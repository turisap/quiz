/**
 * Created by HP on 30-Jul-17.
 */
$(document).ready(function () {
    setTimeout(fadeFlashMessage, 3000);
});

function fadeFlashMessage(){
    $('.flash_message').fadeOut(500);
}