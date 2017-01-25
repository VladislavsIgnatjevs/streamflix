/**
 * Created by vignatjevs on 24/01/2017.
 */
//
// $(document).ready(function () {
//     $('#like-button').click(function (e) {
//         $('like-button').click(function(){
//             $('#like-button').toggleClass('clicked');
//         });
//     });
//
// });


jQuery(function ($) {
    $('.likeBtn').click(function () {
        $(this).toggleClass('highlight');
    })
});