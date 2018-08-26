$(document).ready(function () {
    var brand_id = $("#brand_id").val();
    var category_id = $("#category_id").val();
    if (brand_id != 0){
        $('#marca').val(brand_id);
    }
    if (category_id != 0){
        $('#categoria').val(category_id);
    }
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