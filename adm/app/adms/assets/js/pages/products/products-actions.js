$(function()
{
    $(document).on('click', '.edit-order', function()
    {
        var btsave = $(this).parent().find('a.save-order');
        var text   = $(this).parent().find('span.text-order')
        var input  = $(this).parent().find('input[name=orderby]');

        btsave.show();

        text.hide();

        input.css({'display':'inline-block', 'width':'70px'}).val(text.text().trim());

        $(this).hide();
    });

    $(document).on('click', '.save-order', function()
    {
        var el = $(this);

        var btedit = el.parent().find('a.edit-order');
        var input  = el.parent().find('input[name=orderby]');
        var text   = el.parent().find('span.text-order');
        var id     = el.parent().find('input[name=product_id]').val();

        $.ajax({
            url: "produtos/editOrder",
            data: "id=" + id +'&orderby='+input.val(),
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    var parent = el.parent();

                    $('#msg').text('Ordenação alterada!');

                    btedit.show();

                    input.hide();

                    text.text(data.orderby).show();

                    el.hide();
                }
                else
                {
                    var msg = (data.message) ? data.message : 'Item não encontrado!';
                    $('#msg').text(msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $('#msg').text('Ops! um erro foi encontrado, tente novamente mais tarde!');
            }
        });
    });


    $(document).on('click', '.toggle_new', function()
    {
        let el = $(this);

        let status = el.attr('title');

        let id     = el.parent().find('input[name=product_id]').val();

        $.ajax({
            url: "produtos/toggle",
            data: "id=" + id +'&status='+status,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    var parent = el.parent();

                    $('#msg').text('Status de novidade alterado!');

                    if(data.new == "Ativo"){

                        el.removeClass("btn-primary");

                        el.addClass("btn-warning");

                        el.removeAttr("title");

                        el.attr('title', 'Desativar');


                    }else{

                        el.removeClass("btn-warning");

                        el.addClass("btn-primary");

                        el.removeAttr("title");

                        el.attr('title', 'Ativar');

                    }
                }
                else
                {
                    var msg = (data.message) ? data.message : 'Item não encontrado!';
                    $('#msg').text(msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $('#msg').text('Ops! um erro foi encontrado, tente novamente mais tarde!');
            }
        });
    });
});
