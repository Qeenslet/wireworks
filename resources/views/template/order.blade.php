@extends('wireworks')
@section('content')
    @if(!empty($products))
    <h2>Оформление заказа</h2>
<table class="table">
@foreach($products as $id => $product)
    <tr>
        <?php $pThumbs = $product->getThumbs();?>
        <td><img src = "/media/uploads/{{array_shift($pThumbs)}}" title="{{$product->getName()}}" style="width: 100px"></td>
        <td><strong>{{$product->getName()}}</strong></td>
        <td>
            <b><span id="price{{$id}}" data="{{$product->getPrice($currency)}}" class="total-summ">{{$eachAmount[$id]*$product->getPrice($currency)}}</span></b>
            {!!$curSign!!}
        </td>
        <td>
            <form class="form-inline" action="{{route('changeAmount')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$id}}">
                <div class="form-group">
                    <input type="text" class="form-control amounts" value="{{$eachAmount[$id]}}" style="width: 50px" name="amount">
                    <button class="btn btn-primary">Изменить количество</button>
                </div>
            </form>
        </td>
        <td>
            <a href="{{route('deleteItem', ['id'=>$id])}}" class="btn btn-danger">Удалить</a>
        </td>
    </tr>
@endforeach
</table>
    <hr>
    <h3>Итого:</h3><p style="float:right"><span class="total-summ"> {{$total}}</span> {!!$curSign!!}</p>
    <br>
    <h4>Детали предзаказа</h4>
    <form method="post" action="{{route('applyOrder')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="cartCode" value="{{$cartId}}">
        <div class="form-group">
            <label for="InputName">Ваше имя</label>
            <input type="text" class="form-control" id="InputName" name="name">
            <span id="helpBlock" class="help-block">Обязательно для заполнения</span>
        </div>
        <div class="form-group">
            <label for="InputEmail">Ваш адрес электронной почты</label>
            <input type="email" class="form-control" id="InputEmail" placeholder="Email" name="email">
            <span id="helpBlock" class="help-block">Обязательно для заполнения</span>
        </div>
        <div class="form-group">
            <label for="InputZip">Почтовый индекс</label>
            <input type="text" class="form-control" id="InputZip" name="zipcode" placeholder="101000">
        </div>
        <div class="form-group">
            <label for="InputZip">Адрес доставки. Страна, город, улица, дом, квартира</label>
            <input type="text" class="form-control" id="InputZip" name="address" placeholder="Россия, Москва, ул. Академика Королева, 12 телевизионный центр Останкино">
        </div>
        <div class="form-group">
            <label for="payway">Желательный способ оплаты</label>
            <select class="form-control" id="payway" name="payway">
                <option value="paypal">PayPal</option>
                <option value="yandex">Яндекс-деньги</option>
                <option value="card">Бакновская карта</option>
                <option value="post">Почтовый перевод</option>
                <option value="cash">Наличными при встрече</option>
                <option value="other">Нужно обсудить</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-success">Заказать</button>
        </div>
    </form>
    @else
        <h3>Корзина пуста</h3>
    @endif
@stop