@extends('app')
@section('content')
    <table class="table">
        <tr>
            <th>Фото</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Размеры</th>
            <th>Действия</th>
        </tr>
    @foreach($list as $product)
        <?php $pData = unserialize($product->data);
                $pThumbs = $pData->getThumbs();
        ?>

        <tr>
            <td>
                <img src="/media/uploads/{{array_shift($pThumbs)}}" title="{{$pData->getName()}}">
            </td>
            <td>
                {{$pData->getName()}}
            </td>
            <td>
                {{$product->category->name}}
            </td>
            <td>
                {{$pData->getDescription()}}
            </td>
            <td>
                {{$pData->getAdminPrice()}}
            </td>
            <td>
                @foreach($pData->getDimensions() as $key=>$value)
                    {{$dimensions[$key]}} - {{$value}}<br>
                @endforeach
            </td>
            <td>
                <p><a href="{{route('productEdit', $product->id)}}" class="btn btn-warning">Редактировать</a></p>
                <p><a href="#" class="btn btn-danger" onclick="confirmAction('{{route('deleteProduct', ['id' => $product->id])}}', 'Удалить работу?')">Удалить</a></p>
            </td>
        </tr>
    @endforeach
    </table>
@stop
@section('scripts')
    @parent
    <script>
    @if(isset($message))
        alert('{{$message}}');
    @endif
    </script>
@stop