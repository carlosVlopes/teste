$(function() {

	$('.form-adm').validate({
        rules: {
            name: "required",
            description: "required",
            price: "required",
            orderby: "required",
            status: "required",
            brand: "required",
            colors: "required",
            gender: "required",
            image: "required"
        }
    })

    $('.form-adm-edit').validate({
        rules: {
            name: "required",
            description: "required",
            price: "required",
            orderby: "required",
            status: "required",
            brand: "required",
            colors: "required",
            gender: "required",
        }
    })

    $(".select2_demo_2").select2({
        theme: "classic"
    });

    $('#price').maskMoney({
         prefix: "R$",
         decimal: ",",
         thousands: "."
     });

    $('#old_price').maskMoney({
         prefix: "R$",
         decimal: ",",
         thousands: "."
     });

});
