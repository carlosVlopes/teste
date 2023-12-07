$(function() {

	$('.form-adm').validate({
        rules: {
            name: "required",
            orderby: "required",
            function: "required",
            image: "required"
        }
    })

    $('.form-adm-edit').validate({
        rules: {
            name: "required",
            orderby: "required",
            function: "required"
        }
    })

});
