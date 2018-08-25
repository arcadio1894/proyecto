$(document).ready(function () {
    $formCreate = $('#form-create');
    $formCreate.on('submit', createProduct);
});

var $formCreate;

function createProduct() {
    event.preventDefault();
    var url = $formCreate.attr('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: $formCreate.serialize(),
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
            setTimeout(function () {
                location.reload();
            }, 3000)
        },
        error:function (data) {
            console.log(data);
        }
    });
}