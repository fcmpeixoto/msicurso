"use strict";
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-right",
    };
});

var cleaveCpf = new Cleave('.monetario', {
    numeral: true,
    //numeralThousandsGroupStyle: 'none',
    numeralDecimalScale: 2,
    numeralPositiveOnly: true,
    numeralDecimalMark: ',',
    delimiter: '.'
});


window.addEventListener('modal-hide',event => {
    $('#modal-deleta').modal('hide');
});

window.addEventListener('modal-show',event => {
    $('#modal-deleta').modal('show');
});


window.addEventListener('alert',event => {
    toastr[event.detail.type](event.detail.message, event.detail.titulo) ;
});
