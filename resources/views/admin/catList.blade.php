@extends('app')
@section('content')
    @if(count($errors) > 0)
        @include('errors.display')
    @endif
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Редактирование категории</h4>
                </div>
                <div class="modal-body" id="formPlace">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <tr>
            <th>Название</th>
            <th>URL</th>
            <th>Работы</th>
            <th>Действия</th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->url}}</td>
                <td>
                    <ul>
                    @foreach($category->products()->get() as $product)
                        <?php $obj = unserialize($product->data);?>
                        <li>{{$obj->getName()}}</li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    <p><a href="#" class="btn btn-warning editButt" data="{{$category->id}}">Редактировать</a></p>
                    <p><a href="#" class="btn btn-danger" onclick="confirmAction('{{route('deleteCategory', ['id' => $category->id])}}', 'Удалить категорию?')">Удалить</a></p>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="#" class="btn btn-success newCatB">Новая категория</a>
@stop
@section('scripts')
    @parent
    <script>
        function recieveModalForm(data)
        {
            $.ajax({
                'type':'GET',
                'url':'/home/cat-edit',
                'data': data,
                'success':function(data){
                    $('#formPlace').empty();
                    $('#formPlace').append(data);

                },
                'error':function(msg){
                    $('#formPlace').append(msg)}
            });
        }
        $('.editButt').click(function(e)
        {
            e.preventDefault();
            mess = $(this).attr('data');
            data = 'id=' + mess;
            recieveModalForm(data);
            $('#myModal').modal('show');
        });
        $('.newCatB').click(function(e){
            e.preventDefault();
            data = 'id=new';
            recieveModalForm(data);
            $('#myModal').modal('show');
        });
    </script>
@stop