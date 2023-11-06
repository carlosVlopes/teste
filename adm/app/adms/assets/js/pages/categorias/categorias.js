$(function() {
    $('.form-adm').validate({
        rules: {
            name: "required",
            orderby: "required"
        }
    })
});