<form class="form" action="{{route('catNew')}}">
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    <div class="form-group">
        <label for="NewName">Название</label>
        <input type="text" class="form-control" id="newName" name="name">
    </div>
    <div class="form-group">
        <label for="newURL">URL</label>
        <input type="text" class="form-control" id="newURL" name="url">
    </div>
    <button type="submit" class="btn btn-success">Создать</button>
</form>