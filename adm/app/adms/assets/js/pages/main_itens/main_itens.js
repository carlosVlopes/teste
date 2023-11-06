$(function() {

	$('.form-adm').validate({
        rules: {
            title: "required",
            orderby: "required",
            link_redirect: "required",
            image: "required"
        }
    })

    $('.form-adm-edit').validate({
        rules: {
            title: "required",
            orderby: "required",
            link_redirect: "required"
        }
    })

});
