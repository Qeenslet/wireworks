/**
 * Created by egorg_000 on 08.06.2015.
 */

$(function(){
    $('.control_left').bind('mouseover', function(){
        $('.control_button_left').show();
    });

    $('.col-md-9, #top-banner img').bind('mouseleave', function(){
        $('.control_button_left').fadeOut(300);
        $('.control_button_right').fadeOut(300);
    });
    $('.control_right').bind('mouseover', function(){
        $('.control_button_right').show();
    });
    for(var i=2; i<=picmax; i++) {
        $('<img>').attr({
            'id': 't-ban'+i,
            'src': '/'+dirCour+'/'+i+'.jpg',
            'alt': 'homepage',
            'width': '100%',
            'class':'img-rounded'})
            .css('display', 'none')
            .appendTo('#top-banner');
    }
    function moveBanner(dir){
        if (dir==0) {
            var m = n;
            n+=1;
            if (n>picmax) n=1;
        }
        else {
            var m = n;
            n -= 1;
            if (n==0) n=picmax;
        }
        $('#t-ban'+m).fadeOut(500);
        setTimeout(function(){$('#t-ban'+n).fadeIn(500)}, 500);
    };

    $('#b_left').bind('click', function(event){
        event.preventDefault();
        moveBanner(0);
    });
    $('#b_right').bind('click', function(even){
        even.preventDefault();
        moveBanner(1)});
    setInterval(moveBanner, 10000);
})
