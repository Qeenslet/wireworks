/**
 * Created by egorg_000 on 01.11.2015.
 */

function openCart()
{
    $('#ShopCart').modal('show');
    sendTo('/showcart', 'open=1');
}
function appendItem(step, id)
{
    //sendTo('/updatecart', 'amount='+step+'&id='+id);
    $.ajax({
        'type':'GET',
        'url': '/updatecart',
        'data': 'amount='+step+'&id='+id
    });
    amount = ($('#o'+id).val()) / 1;
    price = ($('#price'+id)).attr('data');
    if(step == 'low')
    {
        newAmount = amount - 1;
    }
    else
    {
        newAmount = amount + 1;
    }
    if (newAmount == 0)
        sendTo('/showcart', 'open=1');
    else
        $('#o'+id).val(newAmount);
    $('#price'+id).text(newAmount * price);
}
function sendTo(addr, data)
{
    $.ajax({
        'type':'GET',
        'url': addr,
        'data':data,
        'success':function(data)
        {
            $('#cartBody').empty();
            $('#cartBody').html(data);
        },
        'error':function(msg)
        {
            console.log(msg);
        }
    });
}