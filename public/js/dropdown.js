// var theToggle = document.getElementsByClassName('toggle');
$('.toggle').on("click", function (e) {
    $(this).find('#toggle').toggleClass('on');
});