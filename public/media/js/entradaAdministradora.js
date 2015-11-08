/**
 * Created by egorg_000 on 13.10.2015.
 */
document.onkeydown = function(e){
    e = e || window.event;
    if(e.ctrlKey && e.keyCode == 69)
    {
        if(confirm('Перейти к администрированию?'))
        {
            location.href='/auth/login';
        }
    }
}
