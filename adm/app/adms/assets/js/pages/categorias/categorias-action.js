$(function()
{
    $(document).on('click', '.edit-category', function(e)
    {
        e.preventDefault();
        el = $(this);

        el.closest('tr').find('td.name-category span').css('display', 'none');
        el.closest('tr').find('td.orderby span').css('display', 'none');
        let name = el.closest('tr').find('input[name="name-category"]');
        let order = el.closest('tr').find('input[name="orderby-category"]');

        name.css({'display':'inline-block', 'width':'450px'});
        order.css({'display':'inline-block', 'width':'150px'});

        el.css('display', 'none');
        el.closest('tr').find('a.save-category').css('display', 'inline-block');

    });

    $(document).on('click', '.save-category', function()
    {
        let el = $(this);

        var name = el.closest('tr').find('input[name="name-category"]'); // procurando a legenda
        var orderby   = el.closest('tr').find('input[name="orderby-category"]'); // procurando a ordem
        var id      = el.closest('form').find('input[name="category_id"]').val(); // pegando o valor do id com o val()

        $.ajax({
            url: "categorias/edit",
            data: "id=" + id +'&orderby='+orderby.val() + '&name='+name.val(),
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    name.val(name.val()).css('visibility', 'hidden'); // esconde o input
                    orderby.val(orderby.val()).css('visibility', 'hidden'); // esconde o input

                    el.closest('tr').find('td.name-category span').text(name.val()).css('display', 'block');
                    el.closest('tr').find('td.orderby span').text(orderby.val()).css('display', 'block');

                    $('#msg').text('Ação efetuada com sucesso!');

                    el.css('display', 'none');
                    el.closest('tr').find('a.edit-category').css('display', 'inline-block');
                }
                else
                {
                    let msg = (data.message) ? data.message : 'Imagem não encontrada!';
                    $('#msg').text(msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $('#msg').text('Ops! um erro foi encontrado, tente novamente mais tarde!');
            }
        });
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var id = $(this).closest('tr').find('input[name=category_id]').val();

        console.log(id);


        $.ajax({
            url: "categorias/delete",
            data: "id=" + id,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    $('#msg').text('Categoria deletada com sucesso!');

                    setTimeout(function(){
                        location.reload();
                    }, 0001);

                }
                else
                {
                    var msg = (data.message) ? data.message : 'Imagem não encontrada!';
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
