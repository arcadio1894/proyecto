$(document).ready(function () {

    $("#productos").on('change', getPrice);
    $("#add-product").on('click', addRow);
    /*$("[data-delete]").on('click', removeElement());*/
    $(document).on('click', '[data-delete]', deleteProduct);

    $formCreate = $('#form-create');
    $formCreate.on('submit', createSale);

    console.log($("#input").val());
    console.log($("#template-products"));
});

var $formCreate;
var productos = [];

function addRow() {
    var url = $("#url-quantity").data('url');
    var cantidad = $("#cantidad").val();
    var cantidadP = $("#quantity-product").val();
    console.log(cantidad + "  " + cantidadP);
    var id = $("#productos").val();
    var nombre = $('#productos option:selected').text();
    var precio = $("#precio").val();
    console.log(nombre);

    if (! $.trim(cantidad)){
        alert('Ingrese cantidad de productos');
        return;
    }

    if (! $.trim(precio)){
        alert('Ingrese precio del producto');
        return;
    }

    /*if ( parseInt(cantidad) > parseInt(cantidadP) ){
        alert('Stock insuficiente');
        return;
    }*/

    // true si es que hay repetidos y false si no hay repetidos
    if (! hayRepetidos(id)){
        productos.push({id:id, name:nombre, price:precio, quantity:cantidad});
        renderTemplateProducts(id, nombre, precio, cantidad);
    } else {
        alert('Este producto ya fue ingresado');
        return;
    }

}

function hayRepetidos(id) {
    for (var i=0; i<productos.length; ++i)
        if (productos[i].id === id)
            return true;

    return false
}

function getPrice() {
    var id = $(this).val();
    var url = $("#url-price").data('url');
    $.getJSON(url+"/"+id, function (data) {
        console.log(data);
        $("#precio").val(data.price);
        $("#quantity-product").val(data.stock);
    });
}

function activeTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}

function renderTemplateProducts(id, name, price, quantity) {
    var clone = activeTemplate('#template-products');
    clone.querySelector("[data-i]").innerHTML = id;
    clone.querySelector("[data-product]").innerHTML = name;
    clone.querySelector("[data-price]").innerHTML = price;
    clone.querySelector("[data-quantity]").innerHTML = quantity;
    clone.querySelector("[data-delete]").setAttribute('data-delete', id);

    $("#table-products").append(clone);
}

function deleteProduct() {
    var $tr = $(this).parents('tr');
    // obtener el id eliminar de mi array el elemento y eliminos
    var id = $(this).data('delete');
    productDeleteArray(id);
    $tr.remove();
}

function productDeleteArray(id) {
    for (var i = 0; i < productos.length; ++i)
        if (productos[i].id == id)
            productos.splice(i, 1);

}

function createSale() {
    event.preventDefault();
    var url = $formCreate.attr('action');
    var data = $(this).serializeArray();
    data.push({name:'productos', value: JSON.stringify(productos)});

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function (data) {
            console.log(data);
            if (data.error) {
                $('#alerts').append('<div class="alert alert-danger " role="alert">'+
                    '<strong>Error! </strong>'+ data.message +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
                '</div>')
            } else {
                $('#alerts').append('<div class="alert alert-success" role="alert">'+
                    '<strong>Éxito! </strong>'+ data.message +
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
