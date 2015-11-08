<form class="form" action="{{route('catApplyChange')}}">
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    <input type="hidden" value="{{$category->id}}" name="id">
    <div class="form-group">
        <label for="NewName">Название</label>
        <input type="text" class="form-control" id="newName" value="{{$category->name}}" name="catName">
    </div>
    <div class="form-group">
        <label for="newURL">URL</label>
        <input type="text" class="form-control" id="newURL" value="{{$category->url}}" name="catUrl">
    </div>
    <button type="submit" class="btn btn-success">Изменить</button>
</form>