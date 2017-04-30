/*Menu*/
//Обработка сайд меню
$(document).ready(function(){
    /*Main menu quick view*/
    $('.navbar-right .dropdown').hover(function() {
        $(this).addClass('open');
    }, function() {
        $(this).removeClass('open');
    });

    function menusetting(x){
        localStorage['menustg'] = x;
    }
    $('.side-nav li[data-toggle="collapse"]').on('show.bs.collapse', function () {
      $(this).addClass('open');
    });
    $('.side-nav li[data-toggle="collapse"]').on('hide.bs.collapse', function () {
      $(this).removeClass('open');
    });
    $('.navbar-header').on('click', '.menu-expand', function(){
        if($('ul.side-nav').hasClass('open')){
            $('ul.side-nav').removeClass('open').addClass('closed');
            $('.menu-expand .fa').removeClass('fa-angle-left').addClass('fa-angle-right');
            menusetting('closed');
            $('#wrapper').attr('style', 'padding-left:50px;');
            $(this).addClass('closed');
        } else if($('ul.side-nav').hasClass('closed')){
            $('ul.side-nav').removeClass('closed').addClass('open');
            $('.menu-expand .fa').removeClass('fa-angle-right').addClass('fa-angle-left');
            menusetting('open');
            $('#wrapper').attr('style', '');
            $(this).removeClass('closed');
        }
    });
    if (localStorage['menustg'] === 'closed') {
        $('.sidenav .nav').removeClass('open').addClass('closed');
        $('.menu-expand .fa').removeClass('fa-angle-left').addClass('fa-angle-right');
        $('#wrapper').attr('style', 'padding-left:50px;');
        $(".menu-expand").addClass('closed');
    }
    //side nav collapse elements
    $('.side-nav').on('click', '.nav-item-a.parent', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $(this).next('ul.sub-menu').collapse("toggle");
    });
});