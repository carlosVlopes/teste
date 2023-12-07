$(function(){

    $('.form_contato').validate({
        rules: {
            name: "required",
            email: "required",
            message: "required",
        },
        submitHandler: function(form) {

            let data = serialize(form);

            $.ajax({
                url: "contato/teste",
                data: "data=" + data,
                dataType:'json',
                type:'post',
                success: function(data) {
                    if(data.status == 'success')
                    {
                        form.hide();
                    }
                    else
                    {
                        var msg = (data.message) ? data.message : 'Item não encontrado!';

                        $(".notification").children().removeClass("alert-success");

                        $(".notification").children().addClass("alert-danger");

                        $(".notification").show();

                        $('#msg').text(msg);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    $(".notification").children().removeClass("alert-success");

                    $(".notification").children().addClass("alert-danger");

                    $(".notification").show();

                    $('#msg').text('Ops! um erro foi encontrado, tente novamente mais tarde!');
                }
            });

        }
    })


    function serialize (form)
    {
        if (!form || form.nodeName !== "FORM") return;

        var i, j, q = [];

        for (i = form.elements.length - 1; i >= 0; i = i - 1)
        {
            if (form.elements[i].name === "") continue;

            switch (form.elements[i].nodeName)
            {
                case 'INPUT':
                    if(['text', 'tel', 'email', 'hidden', 'password', 'button', 'reset', 'submit'].includes(form.elements[i].type))
                    {
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    }
                    else if (['checkbox','radio'].includes(form.elements[i].type))
                    {
                        if (form.elements[i].checked)
                        {
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        }
                    }

                    break;
                case 'TEXTAREA':
                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    break;
                case 'SELECT':
                    if(form.elements[i].type == 'select-one')
                    {
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    }
                    else if(form.elements[i].type == 'select-multiple')
                    {
                        for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1)
                        {
                            if (form.elements[i].options[j].selected)
                            {
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value));
                            }
                        }
                    }

                    break;
                case 'BUTTON':
                    if(['reset', 'submit', 'button', 'hidden', 'password', 'button', 'reset', 'submit'].includes(form.elements[i].type))
                    {
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    }

                    break;
                }
        }

        return q.join("&");
    }


})