$(function(){

// ------- adicionando ao carrinho de compras -----------------------

    $(document).on('click', '.add-cart', function(){

        let el = $(this);

        let id_product = el.parent().find('.id_product').val();

        let price = el.parent().find('.price_product').text();

        let price_product = parseFloat(price.split('R$')[1].replace(',','.'));

        $.ajax({
            url: "carrinho/addCart",
            data: "id=" + id_product,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    el.text("Adicionado com sucesso!");

                    setTimeout(function(){

                        el.text("+ Adicionar ao Carrinho");

                    }, 1000)

                    let current_price = parseFloat($('.price_cart').text().split('R$')[1]);

                    let price_total = current_price + price_product;

                    $('.price_cart').text('R$' + String(price_total));

                    let qnt_products = parseInt($('.qnt_products_cart').text()) + 1;

                    $('.qnt_products_cart').text(qnt_products);

                }
                else
                {
                    console.log('precisa estar logado!')
                }
                },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log('precisa estar logado!')
            }
        });

    });

// ------- adicionando aos items curtidos -----------------------

     $(document).on('click', '.add-likes', function(){

        let el = $(this);

        let id_product = el.parent().parent().parent().find('.id_product').val();

        $.ajax({
            url: "itens-curtidos/addLikes",
            data: "id=" + id_product,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    el.attr('src', 'http://192.168.30.15/estudo/carlos/MVC-template_completo/app/sts/assets/img/icon/heart_red.png')

                    el.removeClass('add-likes');

                    el.addClass('remove-likes');

                }
                else
                {
                    console.log('precisa estar logado!')
                }
                },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log('precisa estar logado!')
            }
        });

    });

// ------- removendo aos items curtidos -----------------------

     $(document).on('click', '.remove-likes', function(){

        let el = $(this);

        let id_product = el.parent().parent().parent().find('.id_product').val();

        $.ajax({
            url: "itens-curtidos/removeLikes",
            data: "id=" + id_product,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    el.attr('src', 'http://192.168.30.15/estudo/carlos/MVC-template_completo/app/sts/assets/img/icon/heart.png')

                    el.removeClass('remove-likes');

                    el.addClass('add-likes');

                }
                else
                {
                    console.log('precisa estar logado!')
                }
                },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log('precisa estar logado!')
            }
        });

    });

})