@extends('wireworks')
@section('content')
    <h2 class="modal_header">{{$pData->getName()}}</h2>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <?php $images = $pData->getImages();?>
        <ol class="carousel-indicators">
            @foreach($pData->getImages() as $key => $image)
                <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" @if($image == reset($images))class="active" @endif></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
        @foreach ($pData->getImages() as $image)

            @if($image == reset($images))
                <div class="item active">
            @else
                <div class="item">
            @endif
                <img src="/media/uploads/{{$image}}" alt="{{$pData->getName()}}">
                <div class="carousel-caption"></div>
            </div>
        @endforeach
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Предыдущая</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Следующая</span>
        </a>
    </div>
    <div class="col-lg-6">
        <h3 class="product-options">Описание</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                {{$pData->getDescription()}}
            </div>
        </div>
        <h3 class="product-options">Размеры</h3>
        <div class="panel panel-default">
            <div class="panel-body">
            @foreach($pData->getDimensions() as $key=>$value)
                <strong>{{$dimensions[$key]}}: </strong> {{$value}}<br>
            @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <h3 class="product-options">Цена</h3>
        <div style="display: block; width: 100%; margin: 20px; text-align: right">
        <p><span class='product-price'>{{$pData->getPrice($currency)}}</span>
            {!!\App\Classes\Helpers\Arrays::currencyLogo($currency)!!}</p>
        </div>
        <hr>
        <div class="form-group">
            <a href="{{route('addToCart', ['id' => $product->id])}}" class="btn btn-lg btn-success" style="float:right">В корзину</a>
        </div>
    </div>
@stop
@section('scripts')
    @parent
    <script>
        $('.carousel').carousel();
    </script>
@stop