@extends('app')
@section('content')
    @if(count($errors) > 0)
        @include('errors.display')
    @endif
    <form class="form-horizontal" method="post" action="{{route('postProduct')}}">
        <p><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"> </span> Добавить новую работу</button></p>
        <input type="hidden" name="_token" value="{{csrf_token()}}" id="pageToken">
        <select name="excluded[]" multiple="multiple" id="excluded" style="display:none"></select>
        <select name="included[]" multiple="multiple" id="included" style="display:none"></select>
        <div class="form-group">
            <label for="pRuName" class="col-sm-2 control-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pRuName" name="ruName" value="{{old('ruName')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="pEnName" class="col-sm-2 control-label">Название на английском</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pEnName" name="enName" value="{{old('enName')}}">
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
                <textarea class="form-control" rows="3" id="descRu" name="descRu" value="{{old('descRu')}}"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="descEn" class="col-sm-2 control-label">Описание на английском</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" id="descEn" name="descEn" value="{{old('descEn')}}"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="longitude" class="col-sm-2 control-label">Длина</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="longitude" name="longitude" value="{{old('longitude')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="diameter" class="col-sm-2 control-label">Диаметр</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="diameter" name="diameter" value="{{old('diameter')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="height" class="col-sm-2 control-label">Высота</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="height" name="height" value="{{old('height')}}">
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
                <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
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
        @if(Request::old('currency'))
            $('#currency').val('{{old('currency')}}');
        @endif
        @if(Request::old('category'))
            $('#cats').val('{{old('category')}}');
        @endif
        @if(Request::old('included'))
            @foreach(Request::old('included') as $picture)
                $('#included').append($('<option>', {
                    value: '{{$picture}}',
                    text: '{{$picture}}',
                    selected: 'selected'
                }));
                <?php $scip=0; ?>
                @if(Request::old('excluded'))
                    @if(in_array($picture, Request::old('excluded')))
                        <?php $scip = 1; ?>
                    @endif
                @endif
                @if($scip != 1)
                    image = $('<img>').attr({
                            src: '/media/uploads/temporary/{{$picture}}',
                            title: '{{$picture}}'
                        }).addClass('thumbimage');
                    $('#list').append(image);
                @endif
            @endforeach
        @endif
        @if(Request::old('excluded'))
            @foreach(Request::old('excluded') as $picture)
                $('#excluded').append($('<option>', {
                        value: '{{$picture}}',
                        text: '{{$picture}}',
                        selected: 'selected'
                }));
            @endforeach
        @endif
        @if(Request::old('descRu'))
            $('#descRu').html('{{old('descRu')}}');
        @endif
        @if(Request::old('descEn'))
            $('#descEn').html('{{old('descEn')}}');
        @endif
    @if(isset($message))
            alert('{{$message}}');
        @endif
    </script>
@stop