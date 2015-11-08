@if(empty($products))
<h3>Корзина пуста!</h3>
@else
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
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><a href="#" onclick="appendItem('low', {{$id}})"><span class="glyphicon glyphicon-minus"></span></a></div>
                            <input type="text" class="form-control amounts" value="{{$eachAmount[$id]}}" style="width: 50px" name="{{$id}}" id="o{{$id}}">
                            <div class="input-group-addon"><a href="#" onclick="appendItem('up', {{$id}})"><span class="glyphicon glyphicon-plus"></span></a></div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endif