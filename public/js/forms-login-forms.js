"use strict";
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var cleaveCpf = new Cleave('.cpf', {
  delimiters: ['.', '.', '-'],
  blocks: [3, 3, 3, 2],
  uppercase: true
});

var cleaveCep = new Cleave('.cep', {
  delimiters: ['-'],
  blocks: [5,3],
  uppercase: true
});

var cleaveNascimento = new Cleave('.nascimento', {
  date: true,
  delimiter: '/',
  datePattern: ['d', 'm', 'Y']
});

var cleaveTelefone = new Cleave('.telefone', {
  delimiters: ['(',')', '-'],
  blocks: [0, 2, 4, 4],
  uppercase: true
});

var cleaveCelular = new Cleave('.celular', {
  delimiters: ['(',')', '-'],
  blocks: [0, 2, 5, 4],
  uppercase: true
});

$("#vcep").focusout(function() {

  let contador = 1;
  let dataSaida;
  let valorNfce;

  $.ajax({
    url: "consulta/cep",
    type: 'POST',
    datatype: 'json',
    data: {
      viacep: $('#vcep').val(),
    },
    beforeSend: function () {
      //$('.preloader img').fadeOut();
      //$('.preloader').fadeOut();
    },
    success: function (response) {

      $('#cidade').val(response.localidade);
      $('#uf').val(response.uf);
      $('#logradouro').val(response.logradouro);
      $('#complemento').val(response.complemento);
      $('#bairro').val(response.bairro);

    },
    error: function (jqXHR) {
      //$('body').loadingModal('destroy');
      console.log(jqXHR.responseText);
    }
  });

});
