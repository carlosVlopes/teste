$(function() {

	$('.form-adm').validate({
        rules: {
            title: "required",
            description: "required",
            orderby: "required",
            banner: "required"
        }
    })

    $('.form-adm-edit').validate({
        rules: {
            name: "required",
            description: "required",
            price: "required",
            orderby: "required"
        }
    })

});
