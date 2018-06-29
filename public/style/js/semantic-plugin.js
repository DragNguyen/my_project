$('.ui.dropdown').dropdown();
$(".ui.accordion").accordion();
$('.ui.tabular.menu .item').tab();
$('.ui.checkbox').checkbox();
$('#toggle-sidebar').click(function() {
    $('#sidebar-mobile').sidebar({
        mobileTransition: 'overlay'
    }).sidebar('toggle')
});

$('.need-popup').popup({position: 'bottom left'});
$('.ui.rating').rating();