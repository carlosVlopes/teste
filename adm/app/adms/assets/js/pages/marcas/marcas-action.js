$(function()
{
    $(document).on('click', '.btn_modal', function(e)
    {
        e.preventDefault();
        el = $(this);

        let id_contact = el.closest('td').find('input[name="contact_id"]').val();

        $.ajax({
            url: "contatos/viewContact",
            data: "id=" + id_contact,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    let data_contact = data.date_contact;

                    let dataFormatada = data_contact.date_contact.replace(/(\d*)-(\d*)-(\d*).*/, '$3-$2-$1');

                    $(".date_contact").text(dataFormatada);
                    $(".name_contact").text(data_contact.name);
                    $(".email_contact").text(data_contact.email);
                    $(".msg_contact").text(data_contact.message);
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

    });


});
