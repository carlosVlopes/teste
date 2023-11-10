$(function(){

    $('#data_1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR'
    });

    $('#price').maskMoney({
         prefix: "R$",
         decimal: ",",
         thousands: "."
     });

});