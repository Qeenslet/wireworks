/**
 * Created by egorg_000 on 15.10.2015.
 */
function displayImages(files)
{
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumbimage" src="', e.target.result,
                    '" title="', escape(theFile.name), '" id="',i,'"/>'].join('');
                document.getElementById('list').insertBefore(span, null);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}
function upload(file)
{
    var xhr = new XMLHttpRequest();
    console.log(file);
    // обработчик для закачки
    xhr.upload.onprogress = function(event) {
        console.log(event.loaded + ' / ' + event.total);
    }

    // обработчики успеха и ошибки
    // если status == 200, то это успех, иначе ошибка
    xhr.onload = xhr.onerror = function() {
        if (this.status == 200) {
            console.log("success");
        } else {
            console.log("error " + this.status);
        }
    };

    var formData = new FormData();
    formData.append('_token', $('#pageToken').val());
    formData.append('files', file);
    xhr.open("POST", "/home/ajax-image", true);
    xhr.send(formData);

}

function handleFileSelect(evt)
{
    var files = evt.target.files; // FileList object
    displayImages(files);
    var file = files[0];
    upload(file);
    name = file.name;
    name = file.name;
    $('#included').append($('<option>', {
        value: name,
        text: name,
        selected: 'selected'
    }));
}
div = $('<div>').css('id', 'fader');
mark = $('#list').offset();

document.getElementById('files').addEventListener('change', handleFileSelect, false);
$('#list').on('mouseover', '.thumbimage', function()
{
    number = $(this).attr('id');
    if($(this).is(':visible'))
    {
        $(this).fadeTo('fast', 0.2, function () {
            pos = $(this).offset();
            var height = $(this).height();
            var width = $(this).width();
            div.css({
                top: mark.top - pos.top - height/1.9,
                left: pos.left - mark.left + width/2.2
            });
            div.addClass('thumbhover');
            div.html("<span class='glyphicon glyphicon-remove-sign'></span>");
            div.appendTo('#list');

        });
    }

});
$('#list').on('mouseout', '.thumbimage', function()
{
    number = $(this).attr('id');
    if($(this).is(':visible'))
    {
        $(this).fadeTo('fast', 1, function () {
            div.remove();
        });
    }

});
$('#list').on('click', '.thumbimage', function()
{
    name = $(this).attr('title');
    number = $(this).attr('id');
    $('#excluded').append($('<option>', {
        value: name,
        text: name,
        selected: 'selected'
    }));
    $(this).hide();
    div.remove();
});
