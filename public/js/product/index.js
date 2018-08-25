$(document).ready(function () {
    $modalDelete = $('#modal-delete');
    $formDelete = $('#form-delete');
    $(document).on('click', '[data-delete]', showModal);
    $formDelete.on('submit', deleteProduct);
    //$('[data-delete]').on('click', mostrar);
});

var $modalDelete;
var $formDelete;

function showModal() {
    var id = $(this).data('id');
    var name = $(this).data('name');

    $formDelete.find('[name=id]').val(id);
    $formDelete.find('[name=nombre]').val(name);
    $modalDelete.modal('show');
}

function deleteProduct() {
    event.preventDefault();
    var url = $formDelete.attr('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: $formDelete.serialize(),
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
                    '<strong>Éxito!!</strong>Producto eliminado correctamente'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                    '</div>');
                $modalDelete.modal('hide');
                setTimeout(function () {
                    location.reload()
                }, 2000);
            }
        },
        error:function (data) {
            console.log(data);
        }
    });
}