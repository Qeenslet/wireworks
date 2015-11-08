<?php $pData = unserialize($product->data);
      $pThumbs = $pData->getThumbs();
?>
<div class="panel-body">
    <table>
        <tr style="height: 160px">
            <td>
                <img src="/media/uploads/{{array_shift($pThumbs)}}" title="{{$pData->getName()}}" class='img-rounded'>
            </td>
        </tr>
        <tr style="height: 95px">
            <td>
                <a href="{{route('singleProduct', $product->id)}}" class="modal_sub" title="На страницу работы" style="text-decoration: none; color:black"><h3>{{$pData->getName()}}</h3></a>
            </td>
        </tr>
        <tr style="height: 20px">
            <td>
                <p><span class='price'>{{$pData->getPrice($currency)}}</span> {!!\App\Classes\Helpers\Arrays::currencyLogo($currency)!!}</p>
            </td>
        </tr>
    </table>

</div>
