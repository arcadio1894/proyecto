$(document).ready(function () {
    $formDate = $('#form-date');
    $formDate.on('submit', sendDate);
});

var $formDate;

function sendDate() {
    event.preventDefault();
    var url = $formDate.attr('action');
    $.ajax({
        url: url,
        method: 'POST',
        data: $formDate.serialize(),
        success: function (data) {
            console.log(data);
        },
        error:function (data) {
            console.log(data);
        }
    })
}
