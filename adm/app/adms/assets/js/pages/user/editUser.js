$(function() {
    $('.form-adm').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            user: "required"
        }
    })
});