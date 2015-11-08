@extends('app')
@section('content')
    @if(count($errors) > 0)
        @include('errors.display')
    @endif
    <form class="form-horizontal" method="post" action="{{route('postProductEdit')}}">
        <p><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"> </span> Изменить работу</button></p>
        <input type="hidden" name="_token" value="{{csrf_token()}}" id="pageToken">
        <input type="hidden" name="pId" value="{{$product->id}}">
        <select name="excluded[]" multiple="multiple" id="excluded" style="display:none"></select>
        <select name="included[]" multiple="multiple" id="included" style="display:none"></select>
        <div class="form-group">
            <label for="pRuName" class="col-sm-2 control-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pRuName" name="ruName" value="{{$pData->getName()}}">
            </div>
        </div>
        <div class="form-group">
            <label for="pEnName" class="col-sm-2 control-label">Название на английском</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pEnName" name="enName" value="{{$pData->getName('en')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="cats" class="col-sm-2 control-label">Категория</label>
            <div class="col-sm-10">
                <select class="form-control" id="cats" name="category">
                    @foreach($cats as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="descRu" class="col-sm-2 control-label">Описание на русском</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" id="descRu" name="descRu"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="descEn" class="col-sm-2 control-label">Описание на английском</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" id="descEn" name="descEn"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="longitude" class="col-sm-2 control-label">Длина</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="longitude" name="longitude" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="diameter" class="col-sm-2 control-label">Диаметр</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="diameter" name="diameter" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="height" class="col-sm-2 control-label">Высота</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="height" name="height" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="currency" class="col-sm-2 control-label">Валюта</label>
            <div class="col-sm-10">
                <select class="form-control" id="currency" name="currency">
                    <option value="BYR">белорусский рубль</option>
                    <option value="RUB">российский рубль</option>
                    <option value="EUR">евро</option>
                    <option value="USD">доллар США</option>
                    <option value="GBP">британский фунт</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Цена</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price" value="{{$pData->getEditPrice()}}">
            </div>
        </div>
    </form>
    <form name="image-upload">
        <label for="files" class="col-sm-2 control-label">Фотографии</label>
        <div class="col-sm-10">
            <input type="file" id="files" name="files" />
            <output id="list"></output>
        </div>
        <br>
    </form>

@stop
@section('scripts')
    @parent
    <script src="/media/js/addManager.js"></script>
    <script>
        $('#currency').val('{{$pData->getCurrency()}}');
        $('#cats').val('{{$product->category->id}}');
        $('#descEn').html('{{$pData->getDescription('en')}}');
        $('#descRu').html('{{$pData->getDescription()}}');

        @foreach($pData->getImages() as $picture)
            $('#included').append($('<option>', {
                value: '{{$picture}}',
                text: '{{$picture}}',
                selected: 'selected'
            }));

            image = $('<img>').attr({
                src: '/media/uploads/{{$picture}}',
                title: '{{$picture}}'
            }).addClass('thumbimage');
            $('#list').append(image);
        @endforeach
        @foreach($pData->getDimensions() as $key=>$value)
            var target='{{$key}}';
            $('#'+target).val('{{$value}}');
        @endforeach
    </script>
@stop