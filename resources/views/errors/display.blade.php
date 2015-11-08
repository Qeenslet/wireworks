<div class="alert alert-danger" id="form-error">
    <strong>Ой! </strong> Ошибочка вышла!<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>