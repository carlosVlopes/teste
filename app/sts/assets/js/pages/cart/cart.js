$(function(){

// ------- adicionando ao carrinho de compras -----------------------

    $(document).on('click', '.pro-qty-2', function(){

        let el = $(this);

        let tr = el.parent().parent().parent();

        let qnt_product = el.find('input').val();

        let id_product = tr.find("input[name='id_product']").val();

        let price = tr.find("input[name='price_product']").val();

        let price_product = parseFloat(price.split('R$')[1].replace(',','.'));

        $.ajax({
            url: "carrinho/qntProductsCart",
            data: "id_product=" + id_product + "&qnt_products=" + qnt_product,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    let price_total = (qnt_product * price_product).toFixed(2).replace('.', ',');

                    tr.find('td.cart__price').text('R$' + price_total);

                    $('.subtotal').text(data.total_price_cart);

                    $('.total_price_cart').text('R$' + data.price_discount);

                    $('.price_cart').text(data.total_price_cart);

                    $('.qnt_products_cart').text(qnt_product);

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


    $(document).on('click', '.cart_close', function(){

        let el = $(this);

        let tr = el.parent().parent();

        let id_product = tr.find("input[name='id_product']").val();

        $.ajax({
            url: "carrinho/deleteProductCart",
            data: "id_product=" + id_product,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    $('.subtotal').text(data.total_price_cart);

                    $('.total_price_cart').text('R$' + data.price_discount);

                    tr.hide();

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


    $(document).on('click', '.add_coupon', function(){

        let el = $(this);

        let coupon = el.parent().find('input.coupon').val();

        $.ajax({
            url: "carrinho/addCoupon",
            data: "coupon=" + coupon,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    if(data.coupon_active == 'true'){

                        $('.cupom_msg').show().text("Já existe algum cupom utilizado!");

                        setTimeout(() => {
                            $('.cupom_msg').hide()
                        }, 1500);

                    }else{

                        $('.cupom_msg').show().text("Cupom utilizado com sucesso!");

                        setTimeout(() => {
                            $('.cupom_msg').hide()
                        }, 1000);

                        let price_cart = parseFloat(data.total_price_cart.split('R$')[1].replace(',','.'));

                        let price_cart_discount = price_cart - (price_cart / 100 * parseInt(data.discount));

                        $('.total_price_cart').text('R$' + price_cart_discount.toFixed(2).replace('.', ','));

                        $('.subtotal').text(data.total_price_cart);

                        $('.coupon_active').text(coupon);

                    }

                }
                else
                {
                    $('.cupom_msg').show().text("Cupom não encontrado!");

                    setTimeout(() => {
                        $('.cupom_msg').hide()
                    }, 1000);

                }
                },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log('precisa estar logado!')
            }
        });

    });


    $(document).on('click', '.remove_coupon', function(){

        let el = $(this);

        let span = el.parent()

        $.ajax({
            url: "carrinho/removeCoupon",
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    span.text('Nenhum');

                    $('.total_price_cart').text('R$' + data.total_price_cart);

                }
                else
                {
                    console.log('erro');

                }
                },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log('precisa estar logado!')
            }
        });

    });



})