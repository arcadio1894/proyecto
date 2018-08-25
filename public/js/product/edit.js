$(document).ready(function () {
    $formEdit = $('#form-edit');
    $formEdit.on('submit', editProduct);
});

var $formEdit;

function editProduct() {
    event.preventDefault();
    var url = $formEdit.attr('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: $formEdit.serialize(),
        success: function (data) {
            if (data != "") {
                for (var property in data) {
                    $('#alerts').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<strong>Error!!</strong>'+ data[property]+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>')
                }
            } else {
                $('#alerts').append('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                    '<strong>Éxito!!</strong>Producto modificado correctamente'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>')
            }
        },
        error:function (data) {
            console.log(data);
        }
    });
}