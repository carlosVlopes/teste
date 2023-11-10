$(function()
{
    $(document).on('click', '.edit-picture', function(e)
    {
        e.preventDefault();
        el = $(this);

        el.closest('tr').find('td.orderby span').css('display', 'none');
        let order = el.closest('tr').find('input[name="orderby-picture"]');

        order.css({'display':'inline-block', 'width':'150px'});

        el.css('display', 'none');
        el.closest('tr').find('a.save-picture').css('display', 'inline-block');

    });

    $(document).on('click', '.save-picture', function()
    {
        let el = $(this);

        var orderby   = el.closest('tr').find('input[name="orderby-picture"]'); // procurando a ordem
        var id      = el.closest('form').find('input[name="picture_id"]').val(); // pegando o valor do id com o val()

        $.ajax({
            url: "galeria-instagram/edit",
            data: "id=" + id +'&orderby='+orderby.val(),
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    orderby.val(orderby.val()).css('visibility', 'hidden'); // esconde o input

                    el.closest('tr').find('td.orderby span').text(orderby.val()).css('display', 'block');

                    $(".notification").show();

                    $('#msg').text('Ação efetuada com sucesso!');

                    el.css('display', 'none');
                    el.closest('tr').find('a.edit-picture').css('display', 'inline-block');
                }
                else
                {
                    let msg = (data.message) ? data.message : 'Imagem não encontrada!';

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
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var id = $(this).closest('tr').find('input[name=picture_id]').val()

        $.ajax({
            url: "galeria-instagram/delete",
            data: "id=" + id,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    $(".notification").show();

                    $('#msg').text('Imagem deletada com sucesso!');

                    setTimeout(function(){
                        location.reload();
                    }, 0001);

                }
                else
                {
                    var msg = (data.message) ? data.message : 'Imagem não encontrada!';

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

    });
});
