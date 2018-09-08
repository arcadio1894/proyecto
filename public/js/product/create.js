$(document).ready(function () {
    var url = $("#typeahead").data('url');
    $.getJSON(url, function (data) {
        $(".typeahead").typeahead(
            {source:data.products}
        );
    });

    $(".chosen-select").chosen();
    $('#descripcion').trumbowyg();
    $formCreate = $('#form-create');
    $formCreate.on('submit', createProduct);

    $("#image").change(function () {
        $("#preview-image").hide();
        showPreview(this);
    });
});

var $formCreate;

function showPreview(input) {
    if (input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview-image").attr('src', e.target.result);

        };
        $("#preview-image").removeAttr("style");
        reader.readAsDataURL(input.files[0]);
    }

}
function createProduct() {
    event.preventDefault();
    var url = $formCreate.attr('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            if (data != "") {
                for (var property in data) {
                    $('#alerts').append('<div class="alert alert-danger " role="alert">'+
                        '<strong>Error! </strong>'+ data[property]+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>')
                }
            } else {
                $('#alerts').append('<div class="alert alert-success" role="alert">'+
                    '<strong>Éxito! </strong>Producto registrado correctamente'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>')
            }
            /*setTimeout(function () {
                location.reload();
            }, 3000)*/
        },
        error:function (data) {
            console.log(data);
        }
    });
}