@extends('wireworks')
@section('content')
    <h2>{{$content->name}}</h2>
    <?php $counter = 1; ?>

        @foreach($products as $product)
            @if($counter == 1)
                <div class="row">
            @endif
            <div class="col-sm-4 listing">
                @include('template.product')
            </div>
            @if($counter == 3)
                </div>
                <?php $counter = 0; ?>
            @endif
                    <?php $counter++; ?>
        @endforeach
        @if($counter == 2 || $counter == 3 )
            </div>
        @endif
@stop
