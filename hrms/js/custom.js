$('.skin-blue .sidebar > .sidebar-menu > li').click(function() {
    $('.skin-blue .sidebar > .sidebar-menu > li.active').removeClass('active');
    $(this).addClass('active');
});