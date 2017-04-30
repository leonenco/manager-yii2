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
    $('.navbar-header .menu-expand').on('click', function(){
        if($('ul.side-nav').hasClass('open')){
            $('ul.side-nav').removeClass('open').addClass('closed');
            menusetting('closed');
            $('#wrapper').attr('style', 'padding-left:50px;');
            $(this).addClass('closed');
        } else if($('ul.side-nav').hasClass('closed')){
            $('ul.side-nav').removeClass('closed').addClass('open');
            menusetting('open');
            $('#wrapper').attr('style', '');
            $(this).removeClass('closed');
        }
    });
});